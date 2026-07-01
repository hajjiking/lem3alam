<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user !== null && $user->role === 'client';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'title_translations' => 'nullable|array',
            'description' => 'required|string',
            'description_translations' => 'nullable|array',
            'category_id' => 'required|exists:categories,id',
            'budget_min' => 'required|numeric|min:0',
            'budget_max' => 'required|numeric|min:0|gte:budget_min',
            'budget_type' => 'required|in:fixed,hourly,project,negotiable',
            'payment_method' => 'nullable|in:cash,card,online',
            'city' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'urgency' => 'required|in:low,medium,high,urgent',
            'deadline' => 'nullable|date|after:today',
            'required_skills' => 'nullable|array',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_remote' => 'boolean',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->hasFile('images') && $this->file('images') instanceof UploadedFile) {
            $this->files->set('images', [$this->file('images')]);
        }
    }

    public function bodyParameters()
    {
        return [
            'title' => [
                'description' => 'The title of the task.',
                'example' => 'Fix my sink',
            ],
            'title_translations' => [
                'description' => 'Translations for the title (e.g., {"fr": "...", "ar": "..."}).',
                'example' => ['fr' => 'Titre en français'],
            ],
            'description' => [
                'description' => 'Detailed description of the task.',
                'example' => 'The sink is leaking water.',
            ],
            'description_translations' => [
                'description' => 'Translations for the description.',
                'example' => ['fr' => 'Description en français'],
            ],
            'category_id' => [
                'description' => 'The ID of the category the task belongs to.',
                'example' => 1,
            ],
            'budget_min' => [
                'description' => 'Minimum budget.',
                'example' => 50,
            ],
            'budget_max' => [
                'description' => 'Maximum budget.',
                'example' => 100,
            ],
            'budget_type' => [
                'description' => 'Type of budget (fixed, hourly, negotiable).',
                'example' => 'fixed',
            ],
            'city' => [
                'description' => 'City where the task is located.',
                'example' => 'Casablanca',
            ],
            'payment_method' => [
                'description' => 'Preferred payment method (cash, card, online).',
                'example' => 'cash',
            ],
            'address' => [
                'description' => 'Specific address for the task.',
                'example' => '123 Main St',
            ],
            'latitude' => [
                'description' => 'Latitude coordinate.',
                'example' => 33.5731,
            ],
            'longitude' => [
                'description' => 'Longitude coordinate.',
                'example' => -7.5898,
            ],
            'deadline' => [
                'description' => 'Deadline for the task.',
                'example' => '2025-12-31',
            ],
            'required_skills' => [
                'description' => 'List of required skills.',
                'example' => ['plumbing', 'repair'],
            ],
            'images' => [
                'description' => 'Array of image files.',
            ],
            'images.*' => [
                'description' => 'Image file.',
            ],
            'urgency' => [
                'description' => 'Urgency level (low, medium, high, urgent).',
                'example' => 'high',
            ],
            'is_remote' => [
                'description' => 'Whether the task can be done remotely.',
                'example' => false,
            ],
        ];
    }
}
