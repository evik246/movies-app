<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface GenreServiceInterface
{
    public function getAllGenres();
    public function getGenreById($id, int $perPage = 10);
    public function createGenre(Request $request);
    public function updateGenre(Request $request, $id);
    public function deleteGenre($id);
}