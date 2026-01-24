<?php

namespace Database\Seeders;

use App\Models\Ministry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MinistrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ministries = [
            ['name' => 'Music Ministry'],
            ['name' => 'Dance Ministry'],
            ['name' => 'Posterity Ministry'],
            ['name' => 'Media Ministry'],
            ['name' => 'Finance Ministry'],
            ['name' => 'Maintenance Ministry'],
            ['name' => 'Ushering Ministry'],
        ];



        foreach ($ministries as $ministry) {
            Ministry::updateOrCreate(
                ['name' => $ministry['name']],
                $ministry
            );
        }
    }
}
