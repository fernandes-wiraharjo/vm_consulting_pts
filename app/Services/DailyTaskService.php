<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DailyTaskService
{
    public function __construct(
        private UserRateService $userRateService,
    ) {}
    
    public function getDailyTasks()
    {
        return DB::table('job_details')
            ->where('id_user', auth()->user()->id)
            ->select('date', DB::raw("SEC_TO_TIME(SUM(TIME_TO_SEC(hour))) as total_hour"))
            ->groupBy('date');
    }

    public function getDailyTaskByDate($date)
    {
        return DB::table('job_details')
            ->join('jobs', 'jobs.id', 'job_details.id_job')
            ->where('job_details.id_user', auth()->user()->id)
            ->where('job_details.date', $date)
            ->select(
                'job_details.id', 'job_details.description', 'job_details.date', 'job_details.hour', 'job_details.is_active',
                'jobs.code'
            );
    }

    public function getTotalHour($date)
    {
        return DB::table('job_details')
            ->where('id_user', auth()->user()->id)
            ->where('date', $date)
            ->selectRaw("SEC_TO_TIME(SUM(TIME_TO_SEC(hour))) as total_hour")
            ->first()->total_hour;
    }

    public function showJobDetail($jobDetailId)
    {
        return DB::table('job_details')
            ->join('jobs', 'jobs.id', 'job_details.id_job')
            ->where('job_details.id', $jobDetailId)
            ->select(
                'job_details.id', 'job_details.id_job', 'job_details.date', 'job_details.description', 'job_details.hour', 'job_details.rate_per_hour', 'job_details.is_active',
                'jobs.code'
            )
            ->first();
    }

    public function storeDailyTask($data)
    {
        $idUser = auth()->user()->id;
        $userRate = $this->userRateService->showUserRateByUser($idUser)->default_rate_per_hour;
        $cost = multiplyTimeByNumber($data['hour'], $userRate);
        
        return DB::transaction(function () use ($idUser, $data, $userRate, $cost) {
            DB::table('job_details')
                ->insert([
                    'id_job' => $data['job_number'],
                    'id_user' => $idUser,
                    'date' => $data['date'],
                    'description' => $data['description'],
                    'hour' => $data['hour'],
                    'rate_per_hour' => $userRate,
                    'cost' => $cost,
                    'created_by' => $idUser,
                    'created_date' => Carbon::now()
                ]);

            $job = DB::table('job_details')
                ->where('id_job', $data['job_number'])
                ->where('is_active', true)
                ->selectRaw("SEC_TO_TIME(SUM(TIME_TO_SEC(hour))) as total_hours, SUM(cost) as total_costs")
                ->first();

            DB::table('jobs')
                ->where('id', $data['job_number'])
                ->update([
                    'total_hours' => $job->total_hours,
                    'total_costs' => $job->total_costs,
                    'updated_by' => auth()->user()->id,
                    'updated_date' => Carbon::now()
                ]);
        });
    }

    public function updateDailyTask($jobDetailId, $data)
    {
        $idUser = auth()->user()->id;
        $dailyTask = $this->showJobDetail($jobDetailId);
        $cost = multiplyTimeByNumber($data['hour'], $dailyTask->rate_per_hour);

        return DB::transaction(function () use ($jobDetailId, $idUser, $data, $cost) {
            DB::table('job_details')
                ->where('id', $jobDetailId)
                ->update([
                    'id_job' => $data['job_number'],
                    'date' => $data['date'],
                    'description' => $data['description'],
                    'hour' => $data['hour'],
                    'cost' => $cost,
                    'updated_by' => $idUser,
                    'updated_date' => Carbon::now()
                ]);

            $job = DB::table('job_details')
                ->where('id_job', $data['job_number'])
                ->where('is_active', true)
                ->selectRaw("SEC_TO_TIME(SUM(TIME_TO_SEC(hour))) as total_hours, SUM(cost) as total_costs")
                ->first();

            DB::table('jobs')
                ->where('id', $data['job_number'])
                ->update([
                    'total_hours' => $job->total_hours,
                    'total_costs' => $job->total_costs,
                    'updated_by' => auth()->user()->id,
                    'updated_date' => Carbon::now()
                ]);
        });
    }

    public function deleteDailyTask($jobDetailId)
    {
        $jobDetail = $this->showJobDetail($jobDetailId);

        $dataUpdate = [
            'updated_by' => auth()->user()->id,
            'updated_date' => Carbon::now()
        ];

        if ($jobDetail->is_active) {
            $dataUpdate['is_active'] = false;
        } else {
            $dataUpdate['is_active'] = true;
        }

        return DB::transaction(function () use ($jobDetailId, $jobDetail, $dataUpdate) {
            DB::table('job_details')
                ->where('id', $jobDetailId)
                ->update($dataUpdate);

            $job = DB::table('job_details')
                ->where('id_job', $jobDetail->id_job)
                ->where('is_active', true)
                ->selectRaw("SEC_TO_TIME(SUM(TIME_TO_SEC(hour))) as total_hours, SUM(cost) as total_costs")
                ->first();

            DB::table('jobs')
                ->where('id', $jobDetail->id_job)
                ->update([
                    'total_hours' => $job->total_hours,
                    'total_costs' => $job->total_costs,
                    'updated_by' => auth()->user()->id,
                    'updated_date' => Carbon::now()
                ]);
        });
    }
}
