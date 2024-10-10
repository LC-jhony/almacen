<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\OrderParchuse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->word,
            'pu' => $this->faker->randomFloat(2, 0, 1000),
            'um' => $this->faker->randomElement(['kg', 'l', 'pcs']),
            'order_id' => OrderParchuse::inRandomOrder()->first()->id,
            'quantity' => $this->faker->randomFloat(2, 1, 1000),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
