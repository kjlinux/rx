<?php

namespace Database\Factories;

use Ramsey\Uuid\Uuid;
use App\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voucher>
 */
class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Voucher::class;

     public function definition(): array
    {
        return [
            //
            'date' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'time' => fake()->time($format = 'H:i:s'),
            'amount_to_pay' => fake()->numberBetween($min = 10000, $max = 999999),
            'payed' => fake()->numberBetween($min = 0, $max = 999999),
            'left_to_pay' => fake()->numberBetween($min = 0, $max = 999999),
            'discount' => fake()->numberBetween($min = 0, $max = 30),
            'amount_after_discount' => fake()->numberBetween($min = 0, $max = 999999),
            'slug' => (string) Uuid::uuid4(),
            'patient_id' => fake()->numberBetween($min = 1, $max = 25)
        ];
    }
}
