<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProjectTrackingService
{
	public function getJobs()
	{
		return DB::table('jobs')
			->join('clients', 'clients.id', 'jobs.id_client')
			->select(
				'jobs.id', 'jobs.code', 'jobs.description', 'jobs.status', 'jobs.total_hours', 'jobs.total_costs', 'jobs.is_active',
				'clients.name as client_name'
			);
	}

	public function storeJob($data)
	{
		return DB::table('jobs')
            ->insert([
                'id_client' => $data['id_client'],
                'code' => $data['code'],
                'description' => $data['description'],
                'created_by' => auth()->user()->id,
                'created_date' => Carbon::now()
            ]);
	}

	public function updateJob($jobId, $data)
	{
		return DB::table('jobs')
            ->where('id', $jobId)
            ->update([
                'id_client' => $data['id_client'],
                'code' => $data['code'],
                'description' => $data['description'],
                'status' => $data['status'],
                'updated_by' => auth()->user()->id,
                'updated_date' => Carbon::now()
            ]);
	}

	public function showJob($jobId)
	{
		return DB::table('jobs')
			->where('id', $jobId)
			->select('id', 'id_client', 'code', 'status', 'description', 'is_active')
			->first();
	}

	public function getJobDetails($jobId)
	{
		return DB::table('jobs')
			->join('job_details', 'job_details.id_job', 'jobs.id')
			->join('users', 'users.id', 'job_details.id_user')
			->where('jobs.id', $jobId)
			->select(
				'users.id as user_id',
				'users.name as user_name',
				DB::raw("SEC_TO_TIME(SUM(TIME_TO_SEC(job_details.hour))) as total_hour"),
				DB::raw("SUM(job_details.cost) as total_cost")
			)
			->groupBy('users.id', 'users.name');
	}

	public function getJobDetailsPerUser($jobId, $userId)
	{
		return DB::table('job_details')
			->where('id_job', $jobId)
			->where('id_user', $userId)
			->select('id', 'date', 'description', 'hour', 'rate_per_hour', 'cost');
	}

	public function updateDetailPerUserJob($jobId, $userId, $jobDetailId, $data)
	{
        return DB::transaction(function () use ($jobId, $userId, $jobDetailId, $data) {
            DB::table('job_details')
                ->where('id', $jobDetailId)
                ->where('id_job', $jobId)
                ->where('id_user', $userId)
                ->update([
                    'rate_per_hour' => $data['rate_per_hour'],
                    'cost' => $data['cost'],
                    'updated_by' => auth()->user()->id,
                    'updated_date' => Carbon::now()
                ]);

            $totalCost = DB::table('job_details')
								->where('is_active', true)
                ->where('id_job', $jobId)
                ->sum('cost');

            DB::table('jobs')
                ->where('id', $jobId)
                ->update([
                    'total_costs' => $totalCost,
                    'updated_by' => auth()->user()->id,
                    'updated_date' => Carbon::now()
                ]);
        });
	}

	public function toggleActivateJob($jobId)
	{
		$job = $this->showJob($jobId);

        $dataUpdate = [
            'updated_by' => auth()->user()->id,
            'updated_date' => Carbon::now()
        ];

        if ($job->is_active) {
            $dataUpdate['is_active'] = false;
        } else {
            $dataUpdate['is_active'] = true;
        }

        return DB::table('jobs')
            ->where('id', $jobId)
            ->update($dataUpdate);
	}
}
