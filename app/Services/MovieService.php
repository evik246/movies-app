<?php

namespace App\Services;

use App\Http\Resources\MovieResource;
use App\Interfaces\ImageServiceInterface;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Interfaces\MovieServiceInterface;

class MovieService implements MovieServiceInterface
{
    protected $posterService;

    public function __construct(ImageServiceInterface $posterService)
    {
        $this->posterService = $posterService;
    }

    public function getAllMovies(int $perPage = 10)
    {
        return MovieResource::collection(Movie::with('genres')->paginate($perPage));
    }

    public function getMovieById($id)
    {
        return MovieResource::make(Movie::with('genres')->findOrFail($id));
    }

    public function createMovie(Request $request)
    {
        if ($request->hasFile('poster')) {
            $posterName = $this->posterService->uploadImage($request, 'poster');
        } else {
            $posterName = $this->posterService->getImageDefaultPath();
        }

        $movie = Movie::create([
            'title' => $request->title,
            'poster' => $posterName,
        ]);

        $movie->genres()->attach($request->genres);
        $movie->load('genres');

        return MovieResource::make($movie);
    }

    public function updateMovie(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        if ($request->hasFile('poster')) {
            if ($movie->poster !== $this->posterService->getImageDefaultPath()) {
                $this->posterService->deleteImage($movie->poster);
            }

            $posterName = $this->posterService->uploadImage($request, 'poster');
            $movie->update(['poster' => $posterName]);
        }
        $movie->update($request->only('title'));
        $movie->genres()->sync($request->genres);
        $movie->load('genres');

        return MovieResource::make($movie);
    }

    public function deleteMovie($id)
    {
        $movie = Movie::findOrFail($id);
        if ($movie->poster !== $this->posterService->getImageDefaultPath()) {
            $this->posterService->deleteImage($movie->poster);
        }
        $movie->genres()->detach();
        $movie->delete();
    }

    public function publishMovie($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->update(['is_published' => true]);
        $movie->load('genres');

        return MovieResource::make($movie);
    }
}