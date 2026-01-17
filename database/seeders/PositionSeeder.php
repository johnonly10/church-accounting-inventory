<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            ['name' => 'Church Chairperson'],
            ['name' => 'Church Vice Chairperson'],
            ['name' => 'Church Secretary'],
            ['name' => 'Church Treasurer'],
            ['name' => 'Church Auditor'],

            ['name' => 'Head Pastor'],
            ['name' => "Pastor's Wife"],

            ['name' => 'Head of Finance Ministry '],
            ['name' => 'Head of Ushering and Hospitality Ministry '],
            ['name' => 'Head of Dance Ministry '],
            ['name' => 'Head of Maintenance Ministry '],
            ['name' => 'Head of Posterity Ministry '],
            ['name' => 'Head of Music Ministry '],
            ['name' => 'Head of Media Ministry '],
        ];

        foreach ($positions as $position)
            Position::updateorCreate(
                ['name' => $position['name']],
                $position
            );
    }
}
