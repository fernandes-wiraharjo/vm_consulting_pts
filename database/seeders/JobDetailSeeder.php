<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;
use Hash;
use DB;

class JobDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $job_details = [
            [
                'job_code' => 'MOCO_CITR23-01',
                'user_name' => 'Anton Prawira',
                'date' => '2023-12-02',
                'description' => 'Review Neraca',
                'hour' => '01:00',
                'rate_per_hour' => 4000000,
                'cost' => 4000000,
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
            [
                'job_code' => 'MOCO_CITR23-01',
                'user_name' => 'Vini Magdalena',
                'date' => '2023-12-01',
                'description' => 'Buat Neraca',
                'hour' => '01:00',
                'rate_per_hour' => 4000000,
                'cost' => 4000000,
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
            [
                'job_code' => 'MOCO_CITR23-01',
                'user_name' => 'Shannon Dharmansyah',
                'date' => '2023-12-01',
                'description' => 'Buat Neraca',
                'hour' => '01:00',
                'rate_per_hour' => 2000000,
                'cost' => 2000000,
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
            [
                'job_code' => 'MOCO_CITR23-02',
                'user_name' => 'Vini Magdalena',
                'date' => '2023-12-01',
                'description' => 'Buat Billing',
                'hour' => '01:30',
                'rate_per_hour' => 4000000,
                'cost' => 6000000,
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
            [
                'job_code' => 'MOCO_CITR23-02',
                'user_name' => 'Vini Magdalena',
                'date' => '2023-12-02',
                'description' => 'Buat Billing 2',
                'hour' => '00:30',
                'rate_per_hour' => 4000000,
                'cost' => 2000000,
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
            [
                'job_code' => 'MOCO_CITR23-02',
                'user_name' => 'Shannon Dharmansyah',
                'date' => '2023-12-01',
                'description' => 'Buat Billing',
                'hour' => '01:00',
                'rate_per_hour' => 2000000,
                'cost' => 2000000,
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
            [
                'job_code' => 'MOCO_CITR23-02',
                'user_name' => 'Shannon Dharmansyah',
                'date' => '2023-12-01',
                'description' => 'Buat Billing 2',
                'hour' => '01:30',
                'rate_per_hour' => 2000000,
                'cost' => 3000000,
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
            [
                'job_code' => 'MOCO_CITR23-02',
                'user_name' => 'Shannon Dharmansyah',
                'date' => '2023-12-02',
                'description' => 'Buat Billing 3',
                'hour' => '00:30',
                'rate_per_hour' => 2000000,
                'cost' => 1000000,
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
        ];

        $job_detail_has_exist = DB::table('job_details')->first();
        if (is_null($job_detail_has_exist)) {
            foreach ($job_details as $job_detail) {
                $job_detail['id_job'] = DB::table('jobs')->where('code', $job_detail['job_code'])->first()->id;
                $job_detail['id_user'] = DB::table('users')->where('name', $job_detail['user_name'])->first()->id;
                unset($job_detail['job_code'], $job_detail['user_name']);
                DB::table('job_details')->insert($job_detail);
            }
        }
    }
}
