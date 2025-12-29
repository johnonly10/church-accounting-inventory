<?php

namespace Database\Seeders;

use App\Models\Leader;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $leaders = [
            ['name' => 'Joshua Addangna', 'nickname' => 'PJ', 'cell_name' => 'Cell ng mga Pogi', 'is_active' => true],
            ['name' => 'Jhaezel Advincula',  'nickname' => 'Zel', 'cell_name' => 'Cell ng mga Ganda', 'is_active' => true],
            ['name' => 'Camille Hernandez', 'nickname' => 'Cams', 'cell_name' => 'Cell', 'is_active' => true],

        ];

        foreach ($leaders as $leader) {
            Leader::updateOrCreate(
                ['name' => $leader['name']],
                $leader
            );
        }
    }
}
