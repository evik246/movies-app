<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\ImageServiceInterface;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PosterService implements ImageServiceInterface
{
    protected string $posterDisk = 'posters';
    protected string $default = 'no-poster-default.png';

    public function uploadImage(Request $request, string $key = null) : string
    {
        if ($request->hasFile($key)) {
            $imageManager = new ImageManager(new Driver());

            $file = $request->file($key);
            $filename = hexdec(uniqid()).'.'.$file->extension();

            $image = $imageManager->read($file);
            $image = $image->resize(240, 360);
            $image->save(storage_path('app/public/'.$this->posterDisk.'/'.$filename));

            return $filename;
        }
        return $this->default;
    }

    public function deleteImage(string $imagePath)
    {
        Storage::disk($this->posterDisk)->delete($imagePath);
    }

    public function getImageUrl(string $imagePath) : string
    {
        return asset('storage/'.$this->posterDisk.'/'.$imagePath);
    }

    public function getImageDefaultPath() : string
    {
        return $this->default;
    }
}