<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\PosterService;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $posterService = resolve(PosterService::class);
        $posterUrl = $posterService->getImageUrl($this->poster);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'poster' => $posterUrl,
            'is_published' => (bool) $this->is_published,
            'genres' => GenreResource::collection($this->genres),
        ];
    }
}
