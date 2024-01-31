<?php

namespace Database\Factories;

use App\Models\Prescriber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prescriber>
 */
class PrescriberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Prescriber::class;

    public function definition(): array
    {
        return [
            //
            'name' => fake()->firstName(),
            'forenames' => fake()->name(),
            'center_id' => fake()->numberBetween($min = 1, $max = 11),
            'function_id' => fake()->numberBetween($min = 1, $max = 4),
            'speciality_id' => fake()->numberBetween($min = 1, $max = 4),
        ];
    }
}
