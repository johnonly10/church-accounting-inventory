<?php

namespace Database\Seeders;

use App\Models\RevenueType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RevenueTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Tithes'],
            ['name' => 'Offering'],

        ];

        foreach ($types as $type) {
            RevenueType::updateOrCreate(
                [
                    'name' => $type['name']
                ],
                $type
            );
        };
    }
}
