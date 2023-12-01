<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;
use Hash;
use DB;

class UserRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $user_rates = [
            [
                'user_name' => 'anton',
                'default_rate_per_hour' => 2000000,
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
            [
                'user_name' => 'andi',
                'default_rate_per_hour' => 1500000,
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
            [
                'user_name' => 'budi',
                'default_rate_per_hour' => 1000000,
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ]
        ];

        foreach ($user_rates as $user_rate) {
            $user_rate['id_user'] = DB::table('users')->where('user_name', $user_rate['user_name'])->first()->id;
            unset($user_rate['user_name']);

            $user_rate_has_exist = DB::table('user_rates')->where('id_user', '=', $user_rate['id_user'])->exists();
            if (!$user_rate_has_exist) {
                DB::table('user_rates')->insert($user_rate);
            }            
        }
    }
}
