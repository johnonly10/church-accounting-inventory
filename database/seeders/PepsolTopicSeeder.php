<?php

namespace Database\Seeders;

use App\Models\PepsolTopic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PepsolTopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pepsolTopics = [
            ['name' => 'Lesson 1'],
            ['name' => 'Lesson 2'],
            ['name' => 'Lesson 3'],
            ['name' => 'Lesson 4'],
            ['name' => 'Lesson 5'],
            ['name' => 'Lesson 6'],
            ['name' => 'Lesson 7'],
            ['name' => 'Lesson 8'],
            ['name' => 'Lesson 9'],
            ['name' => 'Lesson 10'],
        ];

        foreach ($pepsolTopics as $pepsolTopic) {
            PepsolTopic::firstOrCreate(
                ['name' => $pepsolTopic['name']]
            );
        }
    }
}
