<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $codeToId = Category::pluck('id', 'code')->toArray();
        $expenses = [

            ['category_code' => 601, 'name' => 'Pastor Matthew Addangna', 'description' => 'Salary', 'amount' => 4000, 'date' => '2026-01-04'],
            ['category_code' => 605, 'name' => 'Office Supplies', 'description' => 'Print', 'amount' => 15, 'date' => '2026-01-04'],
            ['category_code' => 614, 'name' => 'Finance Ministry', 'description' => 'March 3 Lunch', 'amount' => 150, 'date' => '2026-01-04'],
            ['category_code' => 631, 'name' => 'Posterity Ministry', 'description' => 'Christian Education and Nurture', 'amount' => 400, 'date' => '2026-01-04'],
            ['category_code' => 633, 'name' => 'LSOL', 'description' => 'Training', 'amount' => 400, 'date' => '2026-01-04'],
            ['category_code' => 607, 'name' => 'Love Gift', 'description' => null, 'amount' => 500, 'date' => '2026-01-04'],
            ['category_code' => 614, 'name' => 'Gas', 'description' => null, 'amount' => 960, 'date' => '2026-01-04'],
            ['category_code' => 614, 'name' => 'HFB', 'description' => 'Glass Box', 'amount' => 500, 'date' => '2026-01-04'],
            ['category_code' => 614, 'name' => 'HFB', 'description' => 'Credit', 'amount' => 1000, 'date' => '2026-01-04'],

            ['category_code' => 601, 'name' => 'Pastor Matthew Addangna', 'description' => 'Salary', 'amount' => 4000, 'date' => '2026-01-11'],
            ['category_code' => 631, 'name' => 'Posterity Ministry', 'description' => 'Christian Education and Nurture', 'amount' => 400, 'date' => '2026-01-11'],
            ['category_code' => 633, 'name' => 'LSOL', 'description' => 'Training', 'amount' => 400, 'date' => '2026-01-11'],
            ['category_code' => 614, 'name' => 'Food for Church Worker', 'description' => null, 'amount' => 1000, 'date' => '2026-01-11'],
            ['category_code' => 609, 'name' => 'Flinnvest', 'description' => 'Water Bill', 'amount' => 254, 'date' => '2026-01-11'],
            ['category_code' => 633, 'name' => 'EGR Boys', 'description' => null, 'amount' => 900, 'date' => '2026-01-11'],


            ['category_code' => 601, 'name' => 'Pastor Matthew Addangna', 'description' => 'Salary', 'amount' => 4000, 'date' => '2026-01-18'],
            ['category_code' => 631, 'name' => 'Posterity Ministry', 'description' => 'Christian Education and Nurture', 'amount' => 400, 'date' => '2026-01-18'],
            ['category_code' => 633, 'name' => 'LSOL', 'description' => 'Training', 'amount' => 400, 'date' => '2026-01-18'],
            ['category_code' => 608, 'name' => 'Finance Meeting', 'description' => null, 'amount' => 858, 'date' => '2026-01-18'],
            ['category_code' => 614, 'name' => 'Ostia', 'description' => 'Communion', 'amount' => 170, 'date' => '2026-01-18'],
            ['category_code' => 605, 'name' => 'Office Supplies', 'description' => 'Print', 'amount' => 280, 'date' => '2026-01-18'],
            ['category_code' => 605, 'name' => 'Office Supplies', 'description' => 'Vellum', 'amount' => 122, 'date' => '2026-01-18'],
        ];

        foreach ($expenses as $expense) {
            $code = $expense['category_code'];

            $expense['category_id'] = $codeToId[$code];
            unset($expense['category_code']);

            Expense::updateOrCreate(
                [
                    'category_id' => $expense['category_id'],
                    'name'        => $expense['name'],
                    'description' => $expense['description'],
                    'amount'      => $expense['amount'],
                    'date'        => $expense['date'],
                ],
                $expense
            );
        }
    }
}
