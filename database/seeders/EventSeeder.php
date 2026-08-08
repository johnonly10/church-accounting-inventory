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
                'name' => 'Posterity',
                'short_description' => 'A Christian gathering focused on faith, fellowship, and building a godly generation.',
                'description' => 'Join us for Posterity, a Christian gathering dedicated to strengthening faith, encouraging fellowship, and inspiring the next generation to live according to God’s Word.',
                'image_file' => 'posterity.jpg',
                'location' => 'EMWC, Paradahan 1, Tanza, Cavite',
                'start_at' => $base->copy()->next(Carbon::SATURDAY)->setTime(14, 0),
                'ends_at' => $base->copy()->next(Carbon::SATURDAY)->setTime(17, 0),
            ],
            [
                'name' => 'Sunday Worship',
                'short_description' => 'A time of praise, worship, prayer, and hearing God’s Word.',
                'description' => 'Join us every Sunday as we gather together to worship God through music, prayer, Scripture, fellowship, and the preaching of His Word. Everyone is welcome.',
                'image_file' => 'sunday.jpg',
                'location' => 'EMWC, Paradahan 1, Tanza, Cavite',
                'start_at' => $base->copy()->next(Carbon::SUNDAY)->setTime(9, 0),
                'ends_at' => $base->copy()->next(Carbon::SUNDAY)->setTime(11, 0),
            ],
            [
                'name' => 'Worship Thru Music',
                'short_description' => 'Experience worship and draw closer to God through music and songs.',
                'description' => 'A special worship gathering where we express our love and devotion to God through music, songs, and heartfelt praise. Come and worship with us.',
                'image_file' => 'WTM.jpg',
                'location' => 'EMWC, Paradahan 1, Tanza, Cavite',
                'start_at' => $base->copy()->next(Carbon::FRIDAY)->setTime(19, 0),
                'ends_at' => $base->copy()->next(Carbon::FRIDAY)->setTime(21, 0),
            ],
            [
                'name' => 'Youth Fellowship',
                'short_description' => 'A Christ-centered fellowship for young people to grow in faith and friendship.',
                'description' => 'Join our youth fellowship for worship, Bible teaching, games, meaningful discussions, and fellowship. A place where young people can grow together in faith and build lasting friendships.',
                'image_file' => 'youth fellowship.jpg',
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
