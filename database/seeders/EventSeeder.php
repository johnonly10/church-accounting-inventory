<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $base = Carbon::now()->startOfDay()->addDays(7);
        $dir = 'Images/Events';

        $events = [
            [
                'name' => 'Sunday Worship Service',
                'short_description' => 'A time of praise, worship, and the preaching of God’s Word.',
                'description' => 'Join us for our Sunday worship service featuring congregational singing, prayer, Scripture reading, and a sermon. All are welcome.',
                'image_file' => 'sunday-worship.jpg',
                'location' => 'EMWC, Paradahan 1, Tanza, Cavite',
                'start_at' => $base->copy()->next(Carbon::SUNDAY)->setTime(9, 0),
                'ends_at' => $base->copy()->next(Carbon::SUNDAY)->setTime(11, 0),
            ],
            [
                'name' => 'Midweek Bible Study',
                'short_description' => 'Grow in the Word through teaching and discussion.',
                'description' => 'A midweek gathering for Bible study, fellowship, and prayer. Bring your Bible and invite a friend.',
                'image_file' => 'bible-study.jpg',
                'location' => 'EMWC, Paradahan 1, Tanza, Cavite',
                'start_at' => $base->copy()->next(Carbon::WEDNESDAY)->setTime(19, 0),
                'ends_at' => $base->copy()->next(Carbon::WEDNESDAY)->setTime(20, 30),
            ],
            [
                'name' => 'Prayer Night',
                'short_description' => 'United prayer for the church, community, and nations.',
                'description' => 'An evening of guided prayer, worship, and intercession. Come and experience the power of praying together.',
                'image_file' => 'prayer-night.jpg',
                'location' => 'EMWC, Paradahan 1, Tanza, Cavite',
                'start_at' => $base->copy()->next(Carbon::FRIDAY)->setTime(19, 30),
                'ends_at' => $base->copy()->next(Carbon::FRIDAY)->setTime(21, 0),
            ],
            [
                'name' => 'Youth Fellowship',
                'short_description' => 'Games, worship, and Bible teaching for youth.',
                'description' => 'A weekly fellowship for teens and young adults with worship, interactive teaching, and small group sharing.',
                'image_file' => 'youth-fellowship.jpg',
                'location' => 'EMWC, Paradahan 1, Tanza, Cavite',
                'start_at' => $base->copy()->next(Carbon::SATURDAY)->setTime(16, 0),
                'ends_at' => $base->copy()->next(Carbon::SATURDAY)->setTime(18, 30),
            ],

        ];

        foreach ($events as $event) {
            $slug = Str::slug($event['name']);
            if (DB::table('events')->where('slug', $slug)->exists()) {
                $slug .= '-' . Str::lower(Str::random(5));
            }

            DB::table('events')->insert([
                'name' => $event['name'],
                'slug' => $slug,
                'short_description' => $event['short_description'],
                'description' => $event['description'],
                'image_path' => $dir . '/' . $event['image_file'],
                'start_at' => $event['start_at'],
                'ends_at' => $event['ends_at'],
                'location' => $event['location'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
