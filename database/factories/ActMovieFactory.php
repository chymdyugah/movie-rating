<?php

namespace Database\Factories;

use App\Models\Act;
use App\Models\Movies;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActMovie>
 */
class ActMovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'act_id' => Act::all()->random()->id,
            'movie_id' => Movies::all()->random()->id,
        ];
    }
}
