<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;
use App\Models\Leader;
use App\Models\Ministry;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $deptLeaders = Department::where('name', 'leaders')->first();
        $deptYouth   = Department::where('name', 'youth')->first();

        $leaderJoshua  = Leader::where('name', 'Joshua Addangna')->first();
        $leaderJhaezel = Leader::where('name', 'Jhaezel Advincula')->first();

        $music = Ministry::where('name', 'Music Ministry')->first();
        $media = Ministry::where('name', 'Media Ministry')->first();

        $pastor = User::updateOrCreate(
            ['email' => 'pastor@example.com'],
            [
                'name' => 'Main Pastor',
                'password' => Hash::make('password'),
                'roletype' => 'PASTOR',
                'department_id' => $deptLeaders?->id,
                'leader_id' => $leaderJoshua?->id,
                'email_verified_at' => now(),
            ]
        );

        $staff = User::updateOrCreate(
            ['email' => 'staff@example.com'],
            [
                'name' => 'Sample Staff',
                'password' => Hash::make('password'),
                'roletype' => 'STAFF',
                'department_id' => $deptYouth?->id,
                'leader_id' => $leaderJhaezel?->id,
                'email_verified_at' => now(),
            ]
        );

        if ($music) $pastor->ministries()->syncWithoutDetaching([$music->id]);
        if ($media) $staff->ministries()->syncWithoutDetaching([$media->id]);
    }
}
