<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $positions = [
            [
                'code' => 'ACT',
                'name' => 'Accounting',
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
            [
                'code' => 'MRK',
                'name' => 'Marketing',
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
            [
                'code' => 'SLS',
                'name' => 'Sales',
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ]
        ];

        foreach ($positions as $position) {
            $position_has_exist = DB::table('positions')->where('code', '=', $position['code'])->exists();

            if (!$position_has_exist) {
                DB::table('positions')->insert($position);
            }
        }
    }
}
