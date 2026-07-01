<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'name_translations' => [
                'en' => $this->faker->word(),
                'ar' => 'تصنيف',
                'fr' => 'Catégorie',
            ],
            'description' => $this->faker->sentence(),
            'description_translations' => [
                'en' => $this->faker->sentence(),
                'ar' => 'وصف',
                'fr' => 'Description',
            ],
            'icon' => null,
            'color' => '#3B82F6',
            'is_active' => true,
            'sort_order' => 0,
            'parent_id' => null,
        ];
    }
}
