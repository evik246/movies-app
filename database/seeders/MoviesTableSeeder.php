<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\MovieFactory;

class MoviesTableSeeder extends Seeder
{
    public function run(): void
    {
        MovieFactory::new()->count(20)->create();
    }
}
