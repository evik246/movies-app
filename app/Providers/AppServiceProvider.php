<?php

namespace App\Providers;

use App\Http\Resources\MovieResource;
use App\Interfaces\GenreServiceInterface;
use App\Interfaces\ImageServiceInterface;
use App\Interfaces\MovieServiceInterface;
use App\Services\GenreService;
use App\Services\MovieService;
use App\Services\PosterService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MovieServiceInterface::class, MovieService::class);
        $this->app->bind(GenreServiceInterface::class, GenreService::class);
        $this->app->bind(ImageServiceInterface::class, PosterService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
