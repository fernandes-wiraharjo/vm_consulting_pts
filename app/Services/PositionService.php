<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PositionService
{
    public function getPositions()
    {
        return DB::table('positions')
            ->select('id', 'code', 'name', 'is_active');
    }

    public function storePosition($data)
    {
        return DB::table('positions')
            ->insert([
                'code' => $data['code'],
                'name' => $data['name'],
                'created_by' => auth()->user()->id,
                'created_date' => Carbon::now()
            ]);
    }

    public function showPosition($positionId)
    {
        return DB::table('positions')
            ->where('id', $positionId)
            ->select('id', 'code', 'name', 'is_active')
            ->first();
    }

    public function updatePosition($positionId, $data)
    {
        return DB::table('positions')
            ->where('id', $positionId)
            ->update([
                'code' => $data['code'],
                'name' => $data['name'],
                'updated_by' => auth()->user()->id,
                'updated_date' => Carbon::now()
            ]);
    }

    public function toggleActivatePosition($positionId)
    {
        $position = $this->showPosition($positionId);

        $dataUpdate = [
            'updated_by' => auth()->user()->id,
            'updated_date' => Carbon::now()
        ];

        if ($position->is_active) {
            $dataUpdate['is_active'] = false;
        } else {
            $dataUpdate['is_active'] = true;
        }

        return DB::table('positions')
            ->where('id', $positionId)
            ->update($dataUpdate);
    }
}
