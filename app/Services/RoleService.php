<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleService
{
    public function getRoles()
    {
        return DB::table('roles')
            ->select('id', 'code', 'name');
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
            ->select('id', 'code', 'name')
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

    public function deleteRole($roleId)
    {
        return DB::table('roles')
            ->where('id', $roleId)
            ->delete();
    }
}
