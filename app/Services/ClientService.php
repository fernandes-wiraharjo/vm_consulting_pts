<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClientService
{
    public function getClients()
    {
        return DB::table('clients')
            ->select('id', 'code', 'name', 'email', 'is_active');
    }

    public function storeClient($data)
    {
        if (strpos($data['phone'], '0') === 0) {
            $data['phone'] = '62' . substr($data['phone'], 1);
        }

        return DB::table('clients')
            ->insert([
                'code' => $data['code'],
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'pic' => $data['pic'],
                'address' => $data['address'],
                'description' => $data['description'],
                'created_by' => auth()->user()->id,
                'created_date' => Carbon::now()
            ]);
    }

    public function showClient($clientId)
    {
        return DB::table('clients')
            ->where('id', $clientId)
            ->select('id', 'code', 'name', 'email', 'phone', 'pic', 'address', 'description', 'is_active')
            ->first();
    }

    public function updateClient($clientId, $data)
    {
        if (strpos($data['phone'], '0') === 0) {
            $data['phone'] = '62' . substr($data['phone'], 1);
        }

        return DB::table('clients')
            ->where('id', $clientId)
            ->update([
                'code' => $data['code'],
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'pic' => $data['pic'],
                'address' => $data['address'],
                'description' => $data['description'],
                'updated_by' => auth()->user()->id,
                'updated_date' => Carbon::now()
            ]);
    }

    public function toggleActivateClient($clientId)
    {
        $client = $this->showClient($clientId);

        $dataUpdate = [
            'updated_by' => auth()->user()->id,
            'updated_date' => Carbon::now()
        ];

        if ($client->is_active) {
            $dataUpdate['is_active'] = false;
        } else {
            $dataUpdate['is_active'] = true;
        }

        return DB::table('clients')
            ->where('id', $clientId)
            ->update($dataUpdate);
    }
}
