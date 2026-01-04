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
            ['name' => 'Joshua Addangna', 'nickname' => 'PJ', 'cell_name' => 'Cell ng mga Pogi'],
            ['name' => 'Jhaezel Advincula',  'nickname' => 'Zel', 'cell_name' => 'Cell ng mga Ganda'],
            ['name' => 'Camille Hernandez', 'nickname' => 'Cams', 'cell_name' => 'Cell'],

        ];

        foreach ($leaders as $leader) {
            Leader::updateOrCreate(
                ['name' => $leader['name']],
                $leader
            );
        }
    }
}
