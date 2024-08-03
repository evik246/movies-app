<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Http\Responses\ApiSuccessResponse;
use App\Interfaces\GenreServiceInterface;

class GenreController extends Controller
{
    protected $genreService;

    public function __construct(GenreServiceInterface $genreService)
    {
        $this->genreService = $genreService;
    }

    public function index()
    {
        $genres = $this->genreService->getAllGenres();
        return new ApiSuccessResponse($genres);
    }

    public function store(GenreRequest $request)
    {
        $genre = $this->genreService->createGenre($request);
        return new ApiSuccessResponse($genre, metadata: ['message' => 'The genre has been successfully created.'], code: 201);
    }

    public function show($id)
    {
        $movies = $this->genreService->getGenreById($id);
        if ($movies->isEmpty()) {
            return new ApiSuccessResponse($movies, metadata: ['message' => 'There are no films in this genre.'], code:200);
        }
        return new ApiSuccessResponse($movies, code:200);
    }

    public function update(GenreRequest $request, $id)
    {
        $genre = $this->genreService->updateGenre($request, $id);
        return new ApiSuccessResponse($genre, metadata: ['message' => 'The genre has been successfully updated.'], code: 200);
    }

    public function destroy($id)
    {
        $this->genreService->deleteGenre($id);
        return new ApiSuccessResponse([], metadata: ['message' => 'The genre has been successfully deleted.'], code: 204);
    }
}
