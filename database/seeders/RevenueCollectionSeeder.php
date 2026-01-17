<?php

namespace Database\Seeders;

use App\Models\RevenueCollection;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RevenueCollectionSeeder extends Seeder
{
    public function run(): void
    {
        $start = Carbon::parse('2026-01-04 09:00:00');

        for ($i = 0; $i < 40; $i++) {
            $dt = $start->copy()->addWeeks($i)->format('Y-m-d H:i:s');

            RevenueCollection::updateOrCreate(
                ['collection_date' => $dt],
                ['collection_date' => $dt]
            );
        }
    }
}
