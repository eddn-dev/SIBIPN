<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UnidadAcademicaSeeder::class,
            // Llama aquí a otros seeders que crees
        ]);
    }
}