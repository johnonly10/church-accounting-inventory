<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PepsolCategory;

class PepsolCategorySeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['code' => 'SOL 1-A', 'name' => 'Student of Leaders 1-A'],
            ['code' => 'SOL 1-B', 'name' => 'Student of Leaders 1-B'],

            ['code' => 'SOL 2-A', 'name' => 'Student of Leaders 2-A'],
            ['code' => 'SOL 2-B', 'name' => 'Student of Leaders 2-B'],

            ['code' => 'SOL 3-A', 'name' => 'Student of Leaders 3-A'],
            ['code' => 'SOL 3-B', 'name' => 'Student of Leaders 3-B'],
        ];

        foreach ($rows as $row) {
            PepsolCategory::updateOrCreate(
                ['code' => $row['code']],
                ['name' => $row['name']]
            );
        }
    }
}
