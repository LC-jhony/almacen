<?php

namespace Database\Factories;

use App\Models\OrderParchuse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movement>
 */
class MovementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipo' => $this->faker->randomElement(['entrada', 'salida']),
            'order_id' => OrderParchuse::inRandomOrder()->first()->id,
        ];
    }
}
