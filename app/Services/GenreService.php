<?php

namespace App\Services;

use App\Http\Resources\GenreResource;
use App\Http\Resources\MovieResource;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Interfaces\GenreServiceInterface;

class GenreService implements GenreServiceInterface
{
    public function getAllGenres()
    {
        return GenreResource::collection(Genre::all());
    }

    public function getGenreById($id, int $perPage = 10)
    {
        $genre = Genre::with('movies')->findOrFail($id);
        return MovieResource::collection($genre->movies()->paginate($perPage));
    }

    public function createGenre(Request $request)
    {
        $genre = Genre::create($request->only('name'));
        return GenreResource::make($genre);
    }

    public function updateGenre(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->update($request->only('name'));
        return GenreResource::make($genre);
    }

    public function deleteGenre($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
    }
}
