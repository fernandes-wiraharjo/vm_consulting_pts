<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserRateService
{
    public function getUserRates()
    {
        return DB::table('user_rates')
            ->join('users', 'users.id', 'user_rates.id_user')
            ->select(
                'user_rates.id', 'user_rates.default_rate_per_hour', 'user_rates.is_active',
                'users.name'
            );
    }

    public function storeUserRate($data)
    {
        return DB::table('user_rates')
            ->insert([
                'id_user' => $data['id_user'],
                'default_rate_per_hour' => $data['rate_per_hour'],
                'created_by' => auth()->user()->id,
                'created_date' => Carbon::now()
            ]);
    }

    public function showUserRate($userRateId)
    {
        return DB::table('user_rates')
            ->where('id', $userRateId)
            ->select('id', 'id_user', 'default_rate_per_hour', 'is_active')
            ->first();
    }

    public function showUserRateByUser($userId)
    {
        return DB::table('user_rates')
            ->where('id_user', $userId)
            ->select('id', 'id_user', 'default_rate_per_hour', 'is_active')
            ->first();
    }

    public function updateUserRate($userRateId, $data) {
        return DB::table('user_rates')
            ->where('id', $userRateId)
            ->update([
                'id_user' => $data['id_user'],
                'default_rate_per_hour' => $data['rate_per_hour'],
                'updated_by' => auth()->user()->id,
                'updated_date' => Carbon::now()
            ]);
    }

    public function toggleActivateUserRate($userRateId)
    {
        $userRate = $this->showUserRate($userRateId);

        $dataUpdate = [
            'updated_by' => auth()->user()->id,
            'updated_date' => Carbon::now()
        ];

        if ($userRate->is_active) {
            $dataUpdate['is_active'] = false;
        } else {
            $dataUpdate['is_active'] = true;
        }

        return DB::table('user_rates')
            ->where('id', $userRateId)
            ->update($dataUpdate);
    }
}
