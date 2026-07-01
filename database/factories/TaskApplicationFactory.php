<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskApplication;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskApplicationFactory extends Factory
{
    protected $model = TaskApplication::class;

    public function definition(): array
    {
        return [
            'task_id' => Task::factory(),
            'tasker_id' => User::factory()->tasker(),
            'proposal' => $this->faker->paragraph(),
            'proposal_translations' => [
                'en' => $this->faker->paragraph(),
                'ar' => 'عرض للعمل',
                'fr' => 'Proposition de travail',
            ],
            'proposed_budget' => $this->faker->randomFloat(2, 100, 5000),
            'estimated_duration' => $this->faker->numberBetween(1, 30),
            'experience_description' => $this->faker->sentence(),
            'portfolio_items' => [],
            'status' => 'pending',
        ];
    }

    public function accepted(): static
    {
        return $this->state(fn () => [
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);
    }

    public function rejected(?string $reason = null): static
    {
        return $this->state(fn () => [
            'status' => 'rejected',
            'rejected_at' => now(),
            'rejection_reason' => $reason ?: 'Not a fit',
        ]);
    }
}
