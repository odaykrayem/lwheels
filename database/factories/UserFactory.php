<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'email' => $this->faker->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            'f_name' => $this->faker->name(),
            'l_name' => $this->faker->name(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'ref_code' => $this->faker->unique()->regexify('[A-Za-z0-9]{20}'),
            'ref_times' => $this->faker->numberBetween(0,9),
            'points' => $this->faker->numberBetween(0, 200),
            'balance' => $this->faker->numberBetween(0, 200),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
