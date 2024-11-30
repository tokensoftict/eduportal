<?php

namespace Database\Seeders;

use App\Models\AlevelSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlevelSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            'Mathematics',
            'Physics',
            'Chemistry',
            'Biology',
            'Literature in English',
            'Economics',
            'Business Studies',
            'Accounting',
            'Geography',
            'Agricultural science',
            'Islamic Studies',
            'Christian Religion Knowledge',
        ];

        foreach ($subjects as $subject) {
            AlevelSubject::create([
                'name' => $subject
            ]);
        }
    }
}
