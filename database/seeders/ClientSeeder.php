<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

use DB;
class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $clients = [
            [
                'code' => 'MOCO',
                'name' => 'PT. Mobilecom',
                'created_by' => null,
                'created_date' => $now,
                'updated_by' => null,
                'updated_date' => null
            ]
        ];

        foreach ($clients as $client) {
            $client_has_exist = DB::table('clients')->where('code', '=', $client['code'])->exists();

            if (!$client_has_exist) {
                DB::table('clients')->insert($client);
            }
        }
    }
}
