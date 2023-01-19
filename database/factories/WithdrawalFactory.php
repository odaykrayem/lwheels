<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class WithdrawalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'amount' => $this->faker->numberBetween(1, 10),
            'bank_code' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'status' => $this->faker->randomElement([true, false])

        ];
    }
}
