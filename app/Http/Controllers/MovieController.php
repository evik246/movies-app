<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Interfaces\MovieServiceInterface;
use App\Http\Responses\ApiSuccessResponse;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieServiceInterface $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index()
    {
        $movies = $this->movieService->getAllMovies();
        return new ApiSuccessResponse($movies);
    }

    public function store(StoreMovieRequest $request)
    {
        $movie = $this->movieService->createMovie($request);
        return new ApiSuccessResponse($movie, metadata: ['message' => 'The movie has been successfully created.'], code: 201);
    }

    public function show($id)
    {
        $movie = $this->movieService->getMovieById($id);
        return new ApiSuccessResponse($movie);
    }

    public function update(UpdateMovieRequest $request, $id)
    {
        $movie = $this->movieService->updateMovie($request, $id);
        return new ApiSuccessResponse($movie, metadata: ['message' => 'The movie has been successfully updated.'], code: 200);
    }

    public function destroy($id)
    {
        $this->movieService->deleteMovie($id);
        return new ApiSuccessResponse([], metadata: ['message' => 'The movie has been successfully deleted.'], code: 204);
    }

    public function publish($id)
    {
        $movie = $this->movieService->publishMovie($id);
        return new ApiSuccessResponse($movie, metadata: ['message' => 'The movie has been successfully published.'], code: 200);
    }
}
