<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ImageServiceInterface
{
    public function uploadImage(Request $request, string $key = null) : string;
    public function deleteImage(string $imagePath);
    public function getImageUrl(string $imagePath) : string;
    public function getImageDefaultPath() : string;
}