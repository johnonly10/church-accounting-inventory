<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PepsolCategory;

class PepsolCategorySeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['code' => 'B-1', 'name' => 'Bible Study'],
            ['code' => 'YG-1', 'name' => 'Youth Group'],

            ['code' => 'C-1', 'name' => 'Children Ministry'],
            ['code' => 'P-1', 'name' => 'Parenting'],

            ['code' => 'L-1', 'name' => 'Leadership'],
            ['code' => 'D-1', 'name' => 'Devotional'],
            ['code' => 'DP-1', 'name' => 'Discipleship'],
            ['code' => 'P-1', 'name' => 'Prayer'],
            ['code' => 'E-1', 'name' => 'Evangelism'],
        ];

        foreach ($rows as $row) {
            PepsolCategory::updateOrCreate(
                ['code' => $row['code']],
                ['name' => $row['name']]
            );
        }
    }
}
