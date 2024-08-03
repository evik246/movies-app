<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Genre;
use App\Services\PosterService;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $posterService = resolve(PosterService::class);

        return [
            'title' => $this->faker->sentence,
            'is_published' => $this->faker->boolean,
            'poster' => $posterService->getImageDefaultPath(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($movie) {
            $genres = Genre::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $movie->genres()->attach($genres);
        });
    }
}
