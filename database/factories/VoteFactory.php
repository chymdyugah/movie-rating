<?php

namespace Database\Factories;

use App\Models\Movies;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vote>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'movie_id' => Movies::all()->random()->id,
            'rating' => $this->faker->randomElement([1,2,3,4,5]),
        ];
    }
}
