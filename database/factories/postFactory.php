<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraphs(4, true),
            'user_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
