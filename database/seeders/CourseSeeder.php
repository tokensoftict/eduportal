<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = ['CREATIVE ARTS',
            'ENGLISH LANGUAGE',
            'FRENCH',
            'RUSSIAN',
            'HISTORY & STRATEGIC STUDIES',
            'LINGUISTICS /IGBO',
            'LINGUISTICS /YORUBA',
            'CHINESE',
            'LINGUISTICS',
            'PHILOSOPHY',
            'CHRISTIAN RELIGIOUS KNOWLEDGE',
            'ISLAMIC RELIGIOUS KNOWLEDGE',
            'DENTISTRY',
            'MEDICAL LABORATORY SCIENCE',
            'MEDICINE AND SURGERY',
            'NURSING SCIENCE',
            'PHARMACOLOGY',
            'PHYSIOLOGY',
            'PHYSIOTHERAPHY',
            'RADIOGRAPHY',
            'EDUCATIONAL ADMINISTRATION',
            'EDUCATIONAL FOUNDATIONS',
            'SPECIAL EDUCATION',
            'HEALTH EDUCATION',
            'HUMAN KINETICS',
            'EDUCATION BIOLOGY',
            'EDUCATION CHEMISTRY',
            'EDUCATION HOME ECONOMICS',
            'EDUCATION INTEGRATED SCIENCE',
            'EDUCATION MATHEMATICS',
            'EDUCATION PHYSICS',
            'EDUCATION TECHNOLOGY',
            'BIOMEDICAL ENGINEERING',
            'CHEMICAL & PETROLEUM ENGINEERING',
            'CIVIL & ENVIRONMENTAL ENGINEERING',
            'COMPUTER ENGINEERING',
            'ELECTRICAL & ELECTRONICS ENGINEERING',
            'MECHANICAL ENGINEERING',
            'METALLURGICAL & MATERIALS ENGINEERING',
            'SURVEYING & GEOINFORMATICS ENGINEERING',
            'SYSTEMS ENGINEERING',
            'ARCHITECTURE',
            'BUILDING',
            'ESTATE MANAGEMENT',
            'QUANTITY SURVEYING',
            'URBAN & REGIONAL PLANNING',
            'LAW',
            'ACCOUNTING',
            'ACTUARIAL. SCIENCE',
            'BANKING & FINANCE',
            'BUSINESS ADMINISTRATION',
            'IRPM',
            'INSURANCE',
            'TAXATION',
            'PHARMACY',
            'BOTANY',
            'CELL BIOLOGY &GENETICS',
            'CHEMISTRY',
            'COMPUTER SCIENCE',
            'GEOLOGY',
            'GEOPHYSICS',
            'MARINE BIOLOGY',
            'FISHERIES',
            'MATHEMATICS',
            'INDUSTRIAL MATHEMATICS',
            'STATISTICS',
            'MICROBIOLOGY',
            'PHYSICS',
            'ZOOLOGY',
            'ECONOMICS',
            'ECONOMICS & DEVELOPMENT STUDIES',
            'GEOGRAPHY',
            'METEOROLOGY & CLIMATE SCIENCE',
            'MASS COMMUNICATION ',
            'LIBRARY & INFORMATION SCIENCE ',
            'POLITICAL SCIENCE ',
            'PSYCHOLOGY ',
            'SOCIAL WORK ',
            'SOCIOLOGY'
        ];

        foreach ($courses as $course) {
            DB::table('courses')->insert([
                "name" => $course,
                "description" => $course,
                "prefix" => "",
                "created_at" => now(),
                "updated_at" => now()
            ]);
        }

    }
}
