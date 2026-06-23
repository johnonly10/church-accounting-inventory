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
            ['code' => 'CON-1', 'name' => 'Consolidation'],
            ['code' => 'WG-1', 'name' => 'Worship Gathering'],
            ['code' => 'SG-1', 'name' => 'Small Group'],
            ['code' => 'BSI-1', 'name' => 'Bible Study Intensive'],
            ['code' => 'DOT-1', 'name' => 'Doctrine of Trinity'],
            ['code' => 'OT-1', 'name' => 'Old Testament Survey'],
            ['code' => 'NT-1', 'name' => 'New Testament Survey'],
            ['code' => 'GOF-1', 'name' => 'Gospel of Faith'],
            ['code' => 'SAL-1', 'name' => 'Salvation'],
            ['code' => 'BAP-1', 'name' => 'Baptism'],
            ['code' => 'HSP-1', 'name' => 'Holy Spirit'],
            ['code' => 'COM-1', 'name' => 'Communion'],
            ['code' => 'EVG-1', 'name' => 'Evangelism'],
            ['code' => 'MSN-1', 'name' => 'Mission'],
            ['code' => 'FEL-1', 'name' => 'Fellowship'],
            ['code' => 'GRC-1', 'name' => 'Grace'],
            ['code' => 'RDM-1', 'name' => 'Redemption'],
            ['code' => 'SAN-1', 'name' => 'Sanctification'],
            ['code' => 'PRO-1', 'name' => 'Prophecy'],
            ['code' => 'APO-1', 'name' => 'Apologetics'],
            ['code' => 'CHH-1', 'name' => 'Church History'],
            ['code' => 'COV-1', 'name' => 'Covenant'],
            ['code' => 'KDM-1', 'name' => 'Kingdom of God'],
            ['code' => 'FRT-1', 'name' => 'Fruits of the Spirit'],
            ['code' => 'SPG-1', 'name' => 'Spiritual Gifts'],
        ];

        foreach ($pepsolNames as $pepsolName) {
            PepsolName::firstOrCreate(
                ['code' => $pepsolName['code']],
                ['name' => $pepsolName['name']],
            );
        }
    }
}
