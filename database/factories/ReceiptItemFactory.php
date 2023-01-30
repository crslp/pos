<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReceiptItem>
 */
class ReceiptItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'receipt_id' => 1,
            'price' => rand(1, 4),
            'name' => fake()->randomElement(['Milk', 'Coffee', 'Sprite', 'Soda']),
            'split' => rand(1, 4),
        ];
    }
}
