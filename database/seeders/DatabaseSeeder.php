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
      $this->call(AdminSeeder::class);
      $this->call(GeneralSubjectSeeder::class);
      $this->call([
          CountriesTableSeeder::class,
          StateTableSeeder::class,
          LocalgovtSeeder::class,
          ReligionSeeder::class,
          GenderSeeder::class
      ]);
    }
}
