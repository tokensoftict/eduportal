<?php

namespace Database\Seeders;

use App\Models\Campus;
use Illuminate\Database\Seeder;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $compuses = [
            [
                'name' => 'Lagos Campus',
                'fees' => 210000,
                'noOfInstalments' => 2
            ],
            [
                'name' => 'Ibadan Campus',
                'fees' => 210000,
                'noOfInstalments' => 2
            ],
            [
                'name' => 'Ilorin Campus',
                'fees' => 150000,
                'noOfInstalments' => 2
            ],
            [
                'name' => 'Pategi Campus',
                'fees' => 150000,
                'noOfInstalments' => 2
            ]
        ];

        foreach ($compuses as $compus) {
            Campus::create($compus);
        }
    }
}
