<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'type' => 'logo',
                'name' => 'Logo',
                'path' => 'Images/logo.png',
                'is_active' => true,
            ],
            [
                'type' => 'background',
                'name' => 'Background',
                'path' => 'Images/background.jpg',
                'is_active' => true,
            ],
            [
                'type' => 'background_2',
                'name' => 'Background 2',
                'path' => 'Images/background_2.jpg',
                'is_active' => true,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('images')->updateOrInsert(
                ['type' => $row['type']],
                array_merge($row, [
                    'updated_at' => now(),
                    'created_at' => now(),
                ])
            );
        }
    }
}
