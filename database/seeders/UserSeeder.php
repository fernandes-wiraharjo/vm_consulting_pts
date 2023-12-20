<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;
use Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $users = [
            [
                'id_role' => 1,
                'id_position' => 1,
                'name' => 'Anton',
                'user_name' => 'anton',
                'password' => Hash::make('12345'),
                'default_rate_per_hour' => 2000000,
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
            [
                'id_role' => 2,
                'id_position' => 2,
                'name' => 'Andi',
                'user_name' => 'andi',
                'password' => Hash::make('12345'),
                'default_rate_per_hour' => 1500000,
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
            [
                'id_role' => 3,
                'id_position' => 3,
                'name' => 'Budi',
                'user_name' => 'budi',
                'password' => Hash::make('12345'),
                'default_rate_per_hour' => 1000000,
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
        ];

        foreach ($users as $user) {
            $user_has_exist = DB::table('users')->where('user_name', '=', $user['user_name'])->exists();

            if (!$user_has_exist) {
                if ($user['name'] == 'Anton') {
                    $id_role = DB::table('roles')->where('code', 'ADM')->first()->id;
                } else if ($user['name'] == 'Andi') {
                    $id_role = DB::table('roles')->where('code', 'MGR')->first()->id;
                } else {
                    $id_role = DB::table('roles')->where('code', 'SPV')->first()->id;
                }

                $user['id_role'] = $id_role;

                DB::table('users')->insert($user);
            }
        }
    }
}
