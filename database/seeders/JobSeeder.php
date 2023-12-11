<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;
use Hash;
use DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $jobs = [
            [
                'code' => 'MOCO_CITR23-01',
                'status' => 'open',
                'total_hours' => '03:00',
                'total_costs' => 4500000,
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
            [
                'code' => 'MOCO_CITR23-02',
                'status' => 'close',
                'total_hours' => '05:00',
                'total_costs' => 6000000,
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
        ];

        foreach ($jobs as $job) {
            $job_has_exist = DB::table('jobs')->where('code', $job['code'])->exists();

            if (!$job_has_exist) {
                $job['id_client'] = DB::table('clients')->where('code', 'MOCO')->first()->id;
                DB::table('jobs')->insert($job);
            }
        }
    }
}
