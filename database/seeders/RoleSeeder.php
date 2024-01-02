<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

use DB;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $roles = [
            [
                'code' => 'ADM',
                'name' => 'admin',
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ],
            [
                'code' => 'USR',
                'name' => 'user',
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ]
        ];

        foreach ($roles as $role) {
            $role_has_exist = DB::table('roles')->where('code', '=', $role['code'])->exists();

            if (!$role_has_exist) {
                DB::table('roles')->insert($role);
            }
        }
    }
}
