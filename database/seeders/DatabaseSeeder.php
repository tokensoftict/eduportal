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
            AdminSeeder::class,
            GeneralSubjectSeeder::class,
            CountriesTableSeeder::class,
            DocumentUploadSeeder::class,
            StateTableSeeder::class,
            LocalgovtSeeder::class,
            ReligionSeeder::class,
            GenderSeeder::class,
            SchoolfessSeeder::class,
            CourseSeeder::class,
            AlevelSubjectSeeder::class,
            CampusSeeder::class
        ]);
    }
}
