<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $categories = [
            ['name' => 'Petty Cash Fund', 'code' => '101', 'type' => 'asset'],
            ['name' => 'Revolving Fund', 'code' => '102', 'type' => 'asset'],
            ['name' => 'Cash on Hand', 'code' => '103', 'type' => 'asset'],
            ['name' => 'Cash in Bank - Savings', 'code' => '104', 'type' => 'asset'],
            ['name' => 'Short-term Investment (Time Deposit)', 'code' => '105', 'type' => 'asset'],
            ['name' => 'Cash Advance', 'code' => '106', 'type' => 'asset'],
            ['name' => 'Accounts Receivable', 'code' => '107', 'type' => 'asset'],
            ['name' => 'Inventory - Office Supplies', 'code' => '108', 'type' => 'asset'],
            ['name' => 'Prepaid Expense', 'code' => '109', 'type' => 'asset'],

            ['name' => 'Books', 'code' => '111', 'type' => 'asset'],
            ['name' => 'Musical Instruments', 'code' => '112', 'type' => 'asset'],
            ['name' => 'Acc. Depreciation - Musical Instruments', 'code' => '113', 'type' => 'asset'],
            ['name' => 'Church Furniture & Equipment', 'code' => '114', 'type' => 'asset'],
            ['name' => 'Acc. Depreciation - Ch Furniture & Eqpt.', 'code' => '115', 'type' => 'asset'],
            ['name' => 'Kitchen Wares/ Utensils', 'code' => '116', 'type' => 'asset'],
            ['name' => 'Buildings (Church/ C.E./ Parsonage, etc)', 'code' => '117', 'type' => 'asset'],
            ['name' => 'Acc. Depreciation - Buildings', 'code' => '118', 'type' => 'asset'],
            ['name' => 'Land', 'code' => '119', 'type' => 'asset'],

            ['name' => 'Accounts Payable', 'code' => '201', 'type' => 'liability'],
            ['name' => 'Accrued Expense', 'code' => '202', 'type' => 'liability'],
            ['name' => 'Unearned Income', 'code' => '203', 'type' => 'liability'],

            ['name' => 'Scholarship', 'code' => '301', 'type' => 'funds'],
            ['name' => 'Mission Fund', 'code' => '302', 'type' => 'funds'],
            ['name' => 'Retirement Fund', 'code' => '303', 'type' => 'funds'],
            ['name' => 'Building', 'code' => '304', 'type' => 'funds'],
            ['name' => 'Others', 'code' => '305', 'type' => 'funds'],

            ['name' => 'Supporters', 'code' => '401', 'type' => 'equity'],
            ['name' => 'Donated Capital', 'code' => '402', 'type' => 'equity'],
            ['name' => 'Earnings Prior Years', 'code' => '403', 'type' => 'equity'],
            ['name' => 'Excess (Deficit) of Receipts Over Disb.', 'code' => '404', 'type' => 'equity'],

            ['name' => 'Tithes & Pledges', 'code' => '501', 'type' => 'receipts'],
            ['name' => 'Weekly Offering (Love Offering)', 'code' => '502', 'type' => 'receipts'],
            ['name' => 'Sunday School Offering', 'code' => '503', 'type' => 'receipts'],
            ['name' => 'Harvest Festival', 'code' => '504', 'type' => 'receipts'],
            ['name' => 'Thanksgiving (B-day; graduate; healing; etc.)', 'code' => '505', 'type' => 'receipts'],
            ['name' => 'Mission Offering', 'code' => '506', 'type' => 'receipts'],
            ['name' => 'Grants & Donation', 'code' => '507', 'type' => 'receipts'],
            ['name' => 'Other Income', 'code' => '508', 'type' => 'receipts'],

            ['name' => 'Salaries & Allowances', 'code' => '601', 'type' => 'expenses'],
            ['name' => 'SSS/ PhilHealth/ Pag-IBIG Fund', 'code' => '602', 'type' => 'expenses'],
            ['name' => 'Representation', 'code' => '603', 'type' => 'expenses'],
            ['name' => 'Transportation - General', 'code' => '604', 'type' => 'expenses'],
            ['name' => 'Office Supplies', 'code' => '605', 'type' => 'expenses'],
            ['name' => 'Communication/ Telephone', 'code' => '606', 'type' => 'expenses'],
            ['name' => 'Love Gifts (speakers/ appreciation)', 'code' => '607', 'type' => 'expenses'],
            ['name' => 'Meetings (leaders, congregation)', 'code' => '608', 'type' => 'expenses'],
            ['name' => 'Utilities - Light & Water', 'code' => '609', 'type' => 'expenses'],
            ['name' => 'Repair & Maintenance', 'code' => '610', 'type' => 'expenses'],
            ['name' => 'Janitorial Supplies', 'code' => '611', 'type' => 'expenses'],

            ['name' => 'Annual Events', 'code' => '612', 'type' => 'expenses'],
            ['name' => 'Annual Events - Planning', 'code' => '612A', 'type' => 'expenses'],
            ['name' => 'Annual Events - Anniversary', 'code' => '612B', 'type' => 'expenses'],
            ['name' => 'Annual Events - Christmas Celebration', 'code' => '612C', 'type' => 'expenses'],

            ['name' => 'Capital Expenditures', 'code' => '613', 'type' => 'expenses'],
            ['name' => 'Miscellaneous Exp.', 'code' => '614', 'type' => 'expenses'],

            ['name' => 'Allowances', 'code' => '621', 'type' => 'expenses'],
            ['name' => 'Supplies - Musical', 'code' => '622', 'type' => 'expenses'],
            ['name' => 'Divine Worship', 'code' => '623', 'type' => 'expenses'],
            ['name' => 'Prayer Meetings', 'code' => '624', 'type' => 'expenses'],
            ['name' => 'Others', 'code' => '625', 'type' => 'expenses'],

            ['name' => 'Sunday School - Children', 'code' => '631', 'type' => 'expenses'],
            ['name' => 'Study Materials & Teaching Aids', 'code' => '632', 'type' => 'expenses'],
            ['name' => 'Seminars/ Training/ Retreat/ Camps', 'code' => '633', 'type' => 'expenses'],
            ['name' => 'Support to Ministerial Studies', 'code' => '634', 'type' => 'expenses'],
            ['name' => 'Others', 'code' => '635', 'type' => 'expenses'],

            ['name' => 'Evangelism & Mission', 'code' => '641', 'type' => 'expenses'],
            ['name' => 'Social Concern/ Benevolence', 'code' => '642', 'type' => 'expenses'],
            ['name' => 'Community Relations', 'code' => '643', 'type' => 'expenses'],
            ['name' => 'Other Exp.', 'code' => '644', 'type' => 'expenses'],

            ['name' => 'WMC General', 'code' => '651', 'type' => 'expenses'],
            ['name' => 'WMC General - Apportionment', 'code' => '651A', 'type' => 'expenses'],
            ['name' => 'WMC General - Others', 'code' => '651B', 'type' => 'expenses'],
        ];

        $categories = array_map(function ($c) use ($now) {
            return array_merge($c, [
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }, $categories);

        DB::table('categories')->upsert(
            $categories,
            ['code'],
            ['name', 'type', 'updated_at']
        );
    }
}
