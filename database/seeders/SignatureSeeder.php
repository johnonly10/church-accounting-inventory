<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;
use App\Models\Signature;

class SignatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $signatures = [
            [
                'name' => 'Matthew Addangna',
                'label' => 'Approved by',
                'position_name' => 'Head Pastor'
            ],
            [
                'name' => 'Rowena Sabio',
                'label' => 'Verified by',
                'position_name' => 'Head of Finance Ministry'
            ],
            [
                'name' => 'Kayla Rose Magpantay',
                'label' => 'Certified Correct',
                'position_name' => 'Financial Secretary'
            ],
            [
                'name' => 'Krizielle Reginaldo',
                'label' => 'Certified Correct',
                'position_name' => 'Head Bookkeeper'
            ],
        ];

        foreach ($signatures as $signatureData) {
            $position = Position::where('name', $signatureData['position_name'])->first();

            if ($position) {
                Signature::create([
                    'position_id' => $position->id,
                    'name' => $signatureData['name'],
                    'label' => $signatureData['label'],
                    'is_active' => true
                ]);
            }
        }
    }
}
