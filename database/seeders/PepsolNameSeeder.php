<?php

namespace Database\Seeders;

use App\Models\PepsolName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PepsolNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pepsolNames = [
            [
                'code' => 'CON-1',
                'name' => 'Consolidation',
                'image' => 'discipleship.jpg'
            ],
            [
                'code' => 'WG-1',
                'name' => 'Worship Gathering',
                'image' => 'prayer.jpg'
            ],
            [
                'code' => 'SG-1',
                'name' => 'Small Group',
                'image' => 'youth_group.jpg'
            ],
            [
                'code' => 'BSI-1',
                'name' => 'Bible Study Intensive',
                'image' => 'bible_study.jpg'
            ],
            [
                'code' => 'BAP-1',
                'name' => 'Baptism',
                'image' => 'devotional.jpg'
            ],
            [
                'code' => 'HSP-1',
                'name' => 'Holy Spirit',
                'image' => 'prayer.jpg'
            ],
            [
                'code' => 'COM-1',
                'name' => 'Communion',
                'image' => 'devotional.jpg'
            ],
            [
                'code' => 'EVG-1',
                'name' => 'Evangelism',
                'image' => 'children_ministry.jpg'
            ],
            [
                'code' => 'MSN-1',
                'name' => 'Mission',
                'image' => 'leadership.jpg'
            ],
            [
                'code' => 'FEL-1',
                'name' => 'Fellowship',
                'image' => 'youth_group.jpg'
            ],
            [
                'code' => 'GRC-1',
                'name' => 'Grace',
                'image' => 'devotional.jpg'
            ],
            [
                'code' => 'RDM-1',
                'name' => 'Redemption',
                'image' => 'bible_study.jpg'
            ],
            [
                'code' => 'SAN-1',
                'name' => 'Sanctification',
                'image' => 'discipleship.jpg'
            ],
            [
                'code' => 'PRO-1',
                'name' => 'Prophecy',
                'image' => 'prayer.jpg'
            ],
            [
                'code' => 'APO-1',
                'name' => 'Apologetics',
                'image' => 'leadership.jpg'
            ],
            [
                'code' => 'CHH-1',
                'name' => 'Church History',
                'image' => 'bible_study.jpg'
            ],
            [
                'code' => 'COV-1',
                'name' => 'Covenant',
                'image' => 'discipleship.jpg'
            ],
            [
                'code' => 'KDM-1',
                'name' => 'Kingdom of God',
                'image' => 'children_ministry.jpg'
            ],
            [
                'code' => 'FRT-1',
                'name' => 'Fruits of the Spirit',
                'image' => 'devotional.jpg'
            ],
            [
                'code' => 'SPG-1',
                'name' => 'Spiritual Gifts',
                'image' => 'leadership.jpg'
            ],
        ];

        foreach ($pepsolNames as $pepsolName) {
            PepsolName::firstOrCreate(
                ['code' => $pepsolName['code']],
                [
                    'name' => $pepsolName['name'],
                    'image' => $pepsolName['image']
                ]
            );
        }
    }
}
