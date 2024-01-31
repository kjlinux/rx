<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Patient::class;

    public function definition(): array
    {
        return [
            //
            'name' => fake()->firstName(),
            'forenames' => fake()->name(),
            'gender' => fake()->randomElement(['M', 'F']),
            'age' => fake()->numberBetween($min = 6, $max = 123),
            'phone' => fake()->phoneNumber(),
            'clinical_information' => fake()->sentence(rand(1, 10)),
            'center_id' => fake()->numberBetween($min = 1, $max = 11),
        ];
    }
}
