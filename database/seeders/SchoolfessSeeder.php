<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolfessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fees')->insert([
            [
                'name' => 'School Fees',
                'amount' => 120000,
                'compulsory' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
