<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=>fake()->name(),
            'body'=>fake()->sentence(100),
            'status'=>fake()->randomElement(['DRAFT', 'WAITING', 'PROCESSING', 'COMPLETED']),
            'date'=>fake()->date()
        ];
    }
}
