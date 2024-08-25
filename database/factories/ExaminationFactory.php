<?php

namespace Database\Factories;

use App\Models\Examination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Examination>
 */
class ExaminationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Examination::class;

    public function definition(): array
    {
        return [
            //
            'patient_id' => fake()->numberBetween($min = 1, $max = 25),
            'examination_type_id' => fake()->numberBetween($min = 1, $max = 102),
        ];
    }
}
