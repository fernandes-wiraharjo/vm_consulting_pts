<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserService
{
    public function getUsers()
    {
        return DB::table('users')
            ->leftJoin('roles', 'roles.id', 'users.id_role')
            ->leftJoin('positions', 'positions.id', 'users.id_position')
            ->select(
                'users.id', 'users.name', 'users.user_name', 'users.default_rate_per_hour', 'users.is_active',
                'roles.name AS role_name',
                'positions.name AS position_name'
            );
    }

    public function storeUser($data)
    {
        return DB::table('users')
            ->insert([
                'id_role' => $data['id_role'],
                'id_position' => $data['id_position'],
                'name' => $data['name'],
                'default_rate_per_hour' => $data['default_rate_per_hour'],
                'user_name' => $data['user_name'],
                'password' => Hash::make($data['password']),
                'created_by' => auth()->user()->id,
                'created_date' => Carbon::now()
            ]);
    }

    public function showUser($userId)
    {
        return DB::table('users')
            ->where('id', $userId)
            ->select('id', 'id_role', 'id_position', 'name', 'user_name', 'default_rate_per_hour', 'is_active')
            ->first();
    }

    public function updateUser($userId, $data) {
        $dataUpdate = [
            'id_role' => $data['id_role'],
            'id_position' => $data['id_position'],
            'name' => $data['name'],
            'default_rate_per_hour' => $data['default_rate_per_hour'],
            'user_name' => $data['user_name'],
            'updated_by' => auth()->user()->id,
            'updated_date' => Carbon::now()
        ];

        if ($data['password']) {
            $dataUpdate['password'] = Hash::make($data['password']);
        }

        return DB::table('users')
            ->where('id', $userId)
            ->update($dataUpdate);
    }

    public function toggleActivateUser($userId)
    {
        $user = $this->showUser($userId);

        $dataUpdate = [
            'updated_by' => auth()->user()->id,
            'updated_date' => Carbon::now()
        ];

        if ($user->is_active) {
            $dataUpdate['is_active'] = false;
        } else {
            $dataUpdate['is_active'] = true;
        }

        return DB::table('users')
            ->where('id', $userId)
            ->update($dataUpdate);
    }
}
