<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'client_id' => User::factory()->client(),
            'category_id' => Category::factory(),
            'budget_min' => $this->faker->randomFloat(2, 50, 500),
            'budget_max' => $this->faker->randomFloat(2, 500, 1500),
            'budget_type' => 'fixed',
            'payment_method' => 'cash',
            'status' => 'open',
            'urgency' => $this->faker->randomElement(['low', 'medium', 'high']),
            'deadline' => $this->faker->dateTimeBetween('+2 days', '+2 weeks'),
            'required_skills' => $this->faker->randomElements(['php', 'laravel', 'mysql', 'css'], 2),
            'images' => [],
            'is_remote' => true,
            'applications_count' => 0,
            'location' => $this->faker->city(),
        ];
    }
}
