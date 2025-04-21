<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('religions')->insert([
            [
                'name' => 'Muslim',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Christian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Others',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
