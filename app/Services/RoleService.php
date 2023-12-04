<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleService
{
    public function getRoles()
    {
        return DB::table('roles')
            ->select('id', 'code', 'name', 'is_active');
    }

    public function storeRole($data)
    {
        return DB::table('roles')
            ->insert([
                'code' => $data['code'],
                'name' => $data['name'],
                'created_by' => auth()->user()->id,
                'created_date' => Carbon::now()
            ]);
    }

    public function showRole($roleId)
    {
        return DB::table('roles')
            ->where('id', $roleId)
            ->select('id', 'code', 'name', 'is_active')
            ->first();
    }

    public function updateRole($roleId, $data)
    {
        return DB::table('roles')
            ->where('id', $roleId)
            ->update([
                'code' => $data['code'],
                'name' => $data['name'],
                'updated_by' => auth()->user()->id,
                'updated_date' => Carbon::now()
            ]);
    }

    public function toggleActivateRole($roleId)
    {
        $role = $this->showRole($roleId);

        $dataUpdate = [
            'updated_by' => auth()->user()->id,
            'updated_date' => Carbon::now()
        ];

        if ($role->is_active) {
            $dataUpdate['is_active'] = false;
        } else {
            $dataUpdate['is_active'] = true;
        }

        return DB::table('roles')
            ->where('id', $roleId)
            ->update($dataUpdate);
    }
}
