<?php

namespace Database\Factories;

use App\Models\Send;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Send>
 */
class SendFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Send::class;

    public function definition(): array
    {
        return [
            //
            'patient_id' => fake()->numberBetween($min = 1, $max = 100),
            'prescriber_id' => fake()->numberBetween($min = 1, $max = 10),
        ];
    }
}
