<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface MovieServiceInterface
{
    public function getAllMovies(int $perPage = 10);
    public function getMovieById($id);
    public function createMovie(Request $request);
    public function updateMovie(Request $request, $id);
    public function deleteMovie($id);
    public function publishMovie($id);
}