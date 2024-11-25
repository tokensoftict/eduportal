<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            'Book Keeping',
            'Catering Craft Practice',
            'Chemistry',
            'Christian Studies',
            'Civic Education',
            'Clothing & Textile',
            'Commerce',
            'Computer & IT',
            'Cosmetology',
            'Dyeing & Bleaching',
            'Economics',
            'English Language',
            'Financial Accounting',
            'Fisheries',
            'Food & Nutrition',
            'French',
            'Further Mathematics',
            'Garment Making',
            'General Mathematics',
            'Geography',
            'Government',
            'Hausa',
            'Health Education',
            'History',
            'Home Management',
            'Igbo',
            'Insurance',
            'Islamic Studies',
            'Literature in English',
            'Marketing',
            'Music',
            'Office Practice',
            'Painting & Decorating',
            'Photography',
            'Physical Education',
            'Physics',
            'Salesmanship',
            'Stenography',
            'Store Keeping',
            'Store Management',
            'Tourism',
            'Type Writing',
            'Visual Art',
            'Yoruba'
        ];

        foreach ($subjects as $subject) {
            DB::table('subjects')->insert(['name' => $subject, 'created_at' => now(), 'updated_at' => now()]);
        }
    }
}
