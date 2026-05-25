<?php

namespace Database\Seeders;

use App\Models\Ministry;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ImagesSeeder::class,
            MinistrySeeder::class,
            DepartmentSeeder::class,
            LeaderSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            // RevenueCollectionSeeder::class,
            RevenueTypeSeeder::class,
            // RevenueSeeder::class,

            PositionSeeder::class,
            ExpenseSeeder::class,
            SignatureSeeder::class,
            EventSeeder::class,
            PepsolCategorySeeder::class,
            PepsolTypeSeeder::class,
        ]);
    }
}
