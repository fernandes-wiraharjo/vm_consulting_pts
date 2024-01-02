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
                'code' => 'PARTNER',
                'name' => 'partner',
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
            [
                'code' => 'MGR',
                'name' => 'manager',
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
            [
                'code' => 'SPV',
                'name' => 'supervisor',
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
            [
                'code' => 'TA',
                'name' => 'technical assistant',
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
