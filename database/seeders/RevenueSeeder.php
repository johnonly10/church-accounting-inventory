<?php

namespace Database\Seeders;

use App\Models\Revenue;
use App\Models\RevenueCashCount;
use App\Models\RevenueCollection;
use App\Models\RevenueType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class RevenueSeeder extends Seeder
{
    public function run(): void
    {
        $filipinoNames = [
            'Juan Dela Cruz',
            'Maria Clara Santos',
            'Jose Reyes',
            'Ana Liza Garcia',
            'Mark Anthony Villanueva',
            'Jenny Mae Bautista',
            'Paolo Mendoza',
            'Katrina Flores',
            'Ryan Mercado',
            'Jasmine Aquino',
            'Angelo Navarro',
            'Christine Ramos',
        ];

        $collections = RevenueCollection::orderBy('collection_date')
            ->take(40)
            ->get();

        $typeIdByName = RevenueType::whereIn('name', ['Tithes', 'Offering'])
            ->pluck('id', 'name')
            ->toArray();

        foreach ($collections as $collection) {
            $chosenType = Arr::random(['Tithes', 'Offering']);

            $amount = random_int(1000, 40000);

            $data = [
                'revenue_collection_id' => $collection->id,
                'revenue_type_id'       => $typeIdByName[$chosenType],
                'name'                  => Arr::random($filipinoNames),
                'payment_method'        => Arr::random(['cash', 'gcash']),
                'beneficiary'           => 'general',
                'amount'                => $amount,
            ];

            $revenue = Revenue::updateOrCreate(
                [
                    'revenue_collection_id' => $data['revenue_collection_id'],
                    'beneficiary'           => 'general',
                ],
                $data
            );

            $counts = $this->breakdownToCashCounts((float) $revenue->amount);

            RevenueCashCount::updateOrCreate(
                ['revenue_id' => $revenue->id],
                array_merge(['revenue_id' => $revenue->id], $counts)
            );
        }
    }

    private function breakdownToCashCounts(float $amount): array
    {
        $cents = (int) round($amount * 100);

        $denoms = [
            'bill_1000'  => 100000,
            'bill_500'   => 50000,
            'bill_200'   => 20000,
            'bill_100'   => 10000,
            'bill_50'    => 5000,
            'bill_20'    => 2000,
            'coin_20'    => 2000,
            'coin_10'    => 1000,
            'coin_5'     => 500,
            'coin_1'     => 100,
            'centimo_25' => 25,
            'centimo_10' => 10,
            'centimo_5'  => 5,
            'centimo_1'  => 1,
        ];

        $out = [
            'bill_1000'  => 0,
            'bill_500'   => 0,
            'bill_200'   => 0,
            'bill_100'   => 0,
            'bill_50'    => 0,
            'bill_20'    => 0,
            'coin_20'    => 0,
            'coin_10'    => 0,
            'coin_5'     => 0,
            'coin_1'     => 0,
            'centimo_25' => 0,
            'centimo_10' => 0,
            'centimo_5'  => 0,
            'centimo_1'  => 0,
        ];

        foreach ($denoms as $field => $valueInCents) {
            if ($cents <= 0) break;
            $count = intdiv($cents, $valueInCents);
            $out[$field] = $count;
            $cents -= $count * $valueInCents;
        }

        return $out;
    }
}
