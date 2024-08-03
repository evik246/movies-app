<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\GenreFactory;

class GenresTableSeeder extends Seeder
{
    public function run(): void
    {
        GenreFactory::new()->count(10)->create();
    }
}
