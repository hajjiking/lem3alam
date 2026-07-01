<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user !== null && $user->role === 'tasker';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'proposal' => 'required|string',
            'proposal_translations' => 'nullable|array',
            'proposed_budget' => 'required|numeric|min:0',
            'estimated_duration' => 'required|string|max:100',
            'experience_description' => 'nullable|string',
            'portfolio_items' => 'nullable|array',
        ];
    }

    public function bodyParameters()
    {
        return [
            'proposal' => [
                'description' => 'Your proposal for the task.',
                'example' => 'I can fix this in 2 hours.',
            ],
            'proposal_translations' => [
                'description' => 'Translations for the proposal.',
                'example' => ['fr' => 'Ma proposition...'],
            ],
            'proposed_budget' => [
                'description' => 'The amount you are asking for.',
                'example' => 80,
            ],
            'estimated_duration' => [
                'description' => 'Estimated time to complete the task.',
                'example' => '2 hours',
            ],
            'experience_description' => [
                'description' => 'Brief description of your relevant experience.',
                'example' => 'I have 5 years of plumbing experience.',
            ],
            'portfolio_items' => [
                'description' => 'List of portfolio items to showcase.',
                'example' => [['title' => 'Project 1', 'url' => '...']],
            ],
        ];
    }
}
