<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateTask extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'task:create 
                            {--title= : Task title (required)}
                            {--description= : Task description (required)}
                            {--category= : Category ID or name (required)}
                            {--client= : Client user ID or email (required)}
                            {--budget-min= : Minimum budget (required)}
                            {--budget-max= : Maximum budget (required)}
                            {--budget-type=fixed : Budget type (fixed, hourly, negotiable)}
                            {--location= : Task location}
                            {--city= : Task city}
                            {--urgency=medium : Task urgency (low, medium, high, urgent)}
                            {--deadline= : Task deadline (Y-m-d H:i:s format)}
                            {--skills=* : Required skills (multiple values allowed)}
                            {--remote : Mark task as remote work}
                            {--interactive : Interactive mode for guided task creation}
                            {--create-category= : Create new category if not exists}
                            {--list-categories : List available categories}
                            {--list-clients : List available clients}';

    /**
     * The console command description.
     */
    protected $description = 'Create a new task with comprehensive parameter validation and management';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // Handle utility commands first
            if ($this->option('list-categories')) {
                return $this->listCategories();
            }

            if ($this->option('list-clients')) {
                return $this->listClients();
            }

            // Handle interactive mode
            if ($this->option('interactive')) {
                return $this->interactiveMode();
            }

            // Handle category creation
            if ($this->option('create-category')) {
                $this->createCategory($this->option('create-category'));
            }

            // Create task with provided parameters
            return $this->createTaskFromOptions();

        } catch (ValidationException $e) {
            $this->error('Validation failed:');
            foreach ($e->errors() as $field => $errors) {
                foreach ($errors as $error) {
                    $this->error("  - {$field}: {$error}");
                }
            }

            return Command::FAILURE;
        } catch (\Illuminate\Database\QueryException $e) {
            $this->error('Database error: '.$e->getMessage());
            $this->error('Please check your database connection and try again.');

            return Command::FAILURE;
        } catch (\Exception $e) {
            $this->error('Unexpected error: '.$e->getMessage());
            $this->error('Stack trace: '.$e->getTraceAsString()); // Optional: remove if too verbose

            return Command::FAILURE;
        }
    }

    // Add error handling to createTask method
    protected function createTask(array $taskData)
    {
        try {
            // Validate task data
            $validator = Validator::make($taskData, [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'client_id' => 'required|exists:users,id',
                'budget_min' => 'required|numeric|min:0',
                'budget_max' => 'required|numeric|min:0|gte:budget_min',
                'budget_type' => 'required|in:fixed,hourly,negotiable',
                'location' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:100',
                'urgency' => 'required|in:low,medium,high,urgent',
                'deadline' => 'nullable|date|after:now',
                'required_skills' => 'nullable|array',
                'is_remote' => 'boolean',
                'status' => 'required|in:open,in_progress,completed,cancelled',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            // Create the task
            return Task::create($taskData);
        } catch (\Exception $e) {
            $this->error('Failed to create task: '.$e->getMessage());

            return null;
        }
    }

    /**
     * Create task from command line options
     */
    protected function createTaskFromOptions()
    {
        $this->info('Creating task from provided parameters...');

        // Validate required parameters
        $requiredOptions = ['title', 'description', 'category', 'client', 'budget-min', 'budget-max'];
        $missingOptions = [];

        foreach ($requiredOptions as $option) {
            if (! $this->option($option)) {
                $missingOptions[] = $option;
            }
        }

        if (! empty($missingOptions)) {
            $this->error('Missing required parameters: '.implode(', ', $missingOptions));
            $this->info('Use --interactive flag for guided task creation or --help for parameter details.');

            return Command::FAILURE;
        }

        // Parse and validate parameters
        $taskData = $this->parseTaskParameters();

        // Create the task
        $task = $this->createTask($taskData);

        if ($task) {
            $this->info('✅ Task created successfully!');
            $this->displayTaskSummary($task);

            return Command::SUCCESS;
        }

        return Command::FAILURE;
    }

    /**
     * Interactive mode for guided task creation
     */
    protected function interactiveMode()
    {
        $this->info('🚀 Welcome to Interactive Task Creation!');
        $this->line('');

        $taskData = [];

        // Title
        $taskData['title'] = $this->ask('Enter task title');

        // Description
        $taskData['description'] = $this->ask('Enter task description');

        // Category selection
        $taskData['category_id'] = $this->selectCategory();

        // Client selection
        $taskData['client_id'] = $this->selectClient();

        // Budget
        $taskData['budget_min'] = $this->askNumeric('Enter minimum budget');
        $taskData['budget_max'] = $this->askNumeric('Enter maximum budget', $taskData['budget_min']);

        // Budget type
        $taskData['budget_type'] = $this->choice('Select budget type', ['fixed', 'hourly', 'negotiable'], 'fixed');

        // Location (optional)
        $taskData['location'] = $this->ask('Enter location (optional)', '');
        $taskData['city'] = $this->ask('Enter city (optional)', '');

        // Urgency
        $taskData['urgency'] = $this->choice('Select urgency level', ['low', 'medium', 'high', 'urgent'], 'medium');

        // Remote work
        $taskData['is_remote'] = $this->confirm('Is this remote work?', false);

        // Add the missing status field
        $taskData['status'] = 'open';

        // Deadline (optional)
        $deadline = $this->ask('Enter deadline (Y-m-d H:i:s format, optional)', '');
        if ($deadline) {
            $taskData['deadline'] = $deadline;
        }

        // Required skills (optional)
        $skills = $this->ask('Enter required skills (comma-separated, optional)', '');
        if ($skills) {
            $taskData['required_skills'] = array_map('trim', explode(',', $skills));
        }

        // Confirm before creating
        $this->line('');
        $this->info('Task Summary:');
        $this->displayTaskData($taskData);

        if ($this->confirm('Create this task?', true)) {
            $task = $this->createTask($taskData);

            if ($task) {
                $this->info('✅ Task created successfully!');
                $this->displayTaskSummary($task);

                return Command::SUCCESS;
            }
        } else {
            $this->info('Task creation cancelled.');
        }

        return Command::FAILURE;
    }

    /**
     * Parse task parameters from command options
     */
    protected function parseTaskParameters()
    {
        $taskData = [
            'title' => $this->option('title'),
            'description' => $this->option('description'),
            'budget_min' => (float) $this->option('budget-min'),
            'budget_max' => (float) $this->option('budget-max'),
            'budget_type' => $this->option('budget-type'),
            'location' => $this->option('location'),
            'city' => $this->option('city'),
            'urgency' => $this->option('urgency'),
            'is_remote' => $this->option('remote'),
            'status' => 'open',
        ];

        // Parse category
        $taskData['category_id'] = $this->resolveCategoryId($this->option('category'));

        // Parse client
        $taskData['client_id'] = $this->resolveClientId($this->option('client'));

        // Parse deadline
        if ($this->option('deadline')) {
            $taskData['deadline'] = $this->option('deadline');
        }

        // Parse skills
        if ($this->option('skills')) {
            $taskData['required_skills'] = $this->option('skills');
        }

        return $taskData;
    }

    /**
     * Resolve category ID from input
     */
    protected function resolveCategoryId($categoryInput)
    {
        if (! $categoryInput) {
            return $this->selectCategory();
        }

        // Try to find by ID first
        if (is_numeric($categoryInput)) {
            $category = Category::find($categoryInput);
            if ($category) {
                return $category->id;
            }
            throw new \Exception("Category with ID {$categoryInput} not found.");
        }

        // Try to find by name
        $category = Category::where('name', 'like', "%{$categoryInput}%")->first();
        if (! $category) {
            throw new \Exception("Category '{$categoryInput}' not found. Use --list-categories to see available categories.");
        }

        return $category->id;
    }

    /**
     * Resolve client ID from input
     */
    protected function resolveClientId($clientInput)
    {
        if (! $clientInput) {
            return $this->selectClient();
        }

        // Try to find by ID first
        if (is_numeric($clientInput)) {
            $client = User::where('role', 'client')->find($clientInput);
            if ($client) {
                return $client->id;
            }
            throw new \Exception("User with ID {$clientInput} not found.");
        }

        $client = User::where('email', $clientInput)->first();
        if (! $client) {
            throw new \Exception("User with email '{$clientInput}' not found. Use --list-clients to see available users.");
        }

        return $client->id;
    }

    /**
     * Interactive category selection
     */
    protected function selectCategory()
    {
        $categories = Category::active()->orderBy('name')->get();

        if ($categories->isEmpty()) {
            $this->error('No categories available.');
            if ($this->confirm('Would you like to create a new category?')) {
                return $this->createCategoryInteractive();
            }
            throw new \Exception('No categories available and none created.');
        }

        $choices = $categories->pluck('name', 'id')->toArray();
        $categoryName = $this->choice('Select a category', $choices);

        return $categories->where('name', $categoryName)->first()->id;
    }

    /**
     * Interactive client selection
     */
    protected function selectClient()
    {
        $clients = User::where('role', 'client')->orderBy('name')->get();

        if ($clients->isEmpty()) {
            throw new \Exception('No client users found.');
        }

        // Create choices with display string as key and ID as value
        $choices = $clients->mapWithKeys(function ($client) {
            return ["{$client->name} ({$client->email})" => $client->id];
        })->toArray();

        $selectedDisplay = $this->choice('Select a client', array_keys($choices));

        return $choices[$selectedDisplay];
    }

    /**
     * Ask for numeric input with validation
     */
    protected function askNumeric($question, $min = null)
    {
        do {
            $value = $this->ask($question);

            if (! is_numeric($value)) {
                $this->error('Please enter a valid number.');

                continue;
            }

            $value = (float) $value;

            if ($min !== null && $value < $min) {
                $this->error("Value must be at least {$min}.");

                continue;
            }

            return $value;

        } while (true);
    }

    /**
     * Create a new category
     */
    protected function createCategory($categoryName)
    {
        $this->info("Creating category: {$categoryName}");

        $category = Category::create([
            'name' => $categoryName,
            'description' => $categoryName,
            'is_active' => true,
            'sort_order' => Category::max('sort_order') + 1,
        ]);

        $this->info("✅ Category '{$categoryName}' created with ID: {$category->id}");

        return $category->id;
    }

    /**
     * Interactive category creation
     */
    protected function createCategoryInteractive()
    {
        $name = $this->ask('Enter category name');
        $description = $this->ask('Enter category description', $name);

        $category = Category::create([
            'name' => $name,
            'description' => $description,
            'is_active' => true,
            'sort_order' => Category::max('sort_order') + 1,
        ]);

        $this->info("✅ Category '{$name}' created successfully!");

        return $category->id;
    }

    /**
     * List available categories
     */
    protected function listCategories()
    {
        $categories = Category::active()->orderBy('name')->get();

        if ($categories->isEmpty()) {
            $this->info('No categories available.');

            return Command::SUCCESS;
        }

        $this->info('Available Categories:');
        $this->line('');

        $headers = ['ID', 'Name', 'Description', 'Tasks Count'];
        $rows = $categories->map(function ($category) {
            return [
                $category->id,
                $category->name,
                $category->description ?: 'No description',
                $category->tasks()->count(),
            ];
        })->toArray();

        $this->table($headers, $rows);

        return Command::SUCCESS;
    }

    /**
     * List available clients
     */
    protected function listClients()
    {
        $clients = User::where('role', 'client')->orderBy('name')->get();

        if ($clients->isEmpty()) {
            $this->info('No client users found.');

            return Command::SUCCESS;
        }

        $this->info('Available Clients:');
        $this->line('');

        $headers = ['ID', 'Name', 'Email', 'Tasks Count'];
        $rows = $clients->map(function ($client) {
            return [
                $client->id,
                $client->name,
                $client->email,
                $client->tasks()->count(),
            ];
        })->toArray();

        $this->table($headers, $rows);

        return Command::SUCCESS;
    }

    /**
     * Display task data for confirmation
     */
    protected function displayTaskData(array $taskData)
    {
        $category = Category::find($taskData['category_id']);
        $client = User::find($taskData['client_id']);

        // Add null checks to prevent errors
        if (! $category) {
            $this->error("Error: Category with ID {$taskData['category_id']} not found.");

            return;
        }

        if (! $client) {
            $this->error("Error: Client with ID {$taskData['client_id']} not found.");

            return;
        }

        $this->line("  Title: {$taskData['title']}");
        $this->line("  Description: {$taskData['description']}");
        $this->line("  Category: {$category->name} (ID: {$category->id})");
        $this->line("  Client: {$client->name} ({$client->email})");
        $this->line("  Budget: {$taskData['budget_min']} - {$taskData['budget_max']} ({$taskData['budget_type']})");
        $this->line('  Location: '.($taskData['location'] ?: 'Not specified'));
        $this->line('  City: '.($taskData['city'] ?: 'Not specified'));
        $this->line("  Urgency: {$taskData['urgency']}");
        $this->line('  Remote: '.($taskData['is_remote'] ? 'Yes' : 'No'));

        if (isset($taskData['deadline'])) {
            $this->line("  Deadline: {$taskData['deadline']}");
        }

        if (isset($taskData['required_skills'])) {
            $this->line('  Skills: '.implode(', ', $taskData['required_skills']));
        }
    }

    /**
     * Display task summary after creation
     */
    protected function displayTaskSummary(Task $task)
    {
        $task->load(['category', 'client']);

        $this->line('');
        $this->info('Task Details:');
        $this->line("  ID: {$task->id}");
        $this->line("  Title: {$task->title}");
        $this->line('  Category: '.($task->category ? $task->category->getAttribute('name') : ''));
        $this->line('  Client: '.($task->client ? $task->client->getAttribute('name') : ''));
        $this->line("  Budget: {$task->budget_min} - {$task->budget_max} ({$task->budget_type})");
        $this->line("  Status: {$task->status}");
        $this->line("  Created: {$task->created_at->format('Y-m-d H:i:s')}");
        $this->line('');
    }
}
