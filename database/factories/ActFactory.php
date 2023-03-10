<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Act>
 */
class ActFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->sentence(),
            'dob' => $this->faker->date(),
            'country' => $this->faker->randomElement(['Nigeria', 'UK', 'Germany', 'Russia', 'United States', 'Canada', 'France'])
        ];
    }
}
