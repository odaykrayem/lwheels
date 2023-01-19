<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'prize' => $this->faker->numberBetween(100, 2000),
            'description' => $this->faker->text(),
            'duration' => $this->faker->numberBetween(1, 10)
        ];
    }
}
