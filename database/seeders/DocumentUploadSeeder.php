<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentUploadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $docs = [
            "Passport",
            "O Level",
            "NIN"
        ];
        foreach ($docs as $doc) {
            DB::table('document_uploads')->insert(
                [
                    "name" => $doc,
                    "created_at" => now(),
                    "updated_at" => now()
                ]
            );
        }

    }
}
