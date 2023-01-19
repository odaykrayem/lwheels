<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'key' => $this->faker->unique()->randomElement(['wheel_points','referral_points_user','referral_points_owner', 'points_price', 'minimum_points']),
            'value' => $this->faker->randomElement([1,50,100,150])
        ];
    }
}
