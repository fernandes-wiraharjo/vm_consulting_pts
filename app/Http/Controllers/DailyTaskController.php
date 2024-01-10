<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DailyTaskService;
use App\Services\ProjectTrackingService;
use Yajra\DataTables\Facades\DataTables;

class DailyTaskController extends Controller
{
    public function __construct(
        private DailyTaskService $dailyTaskService,
        private ProjectTrackingService $projectTrackingService,
    ) {}

    public function index(Request $request)
    {
        $dailyTasks = $this->dailyTaskService->getDailyTasks()->where('job_details.is_active', true);

        if ($request->ajax()) {
            return DataTables::of($dailyTasks)
                ->editColumn('date', function($dailyTask) {
                    return date('d M Y', strtotime($dailyTask->date));
                })
                ->filterColumn('date', function($query, $keyword) {
                    $sql = "DATE_FORMAT(date, '%a, %d %b %Y') LIKE ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->addColumn('action', function($dailyTask) {
                    $urlDetail = route('daily-task::detail', ['date' => $dailyTask->date]);

                    $action = '<a href="'.$urlDetail.'" class="btn btn-sm btn-secondary">Detail</a>';

                    return $action;
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('daily-task.index');
    }

    public function create()
    {
        $jobs = $this->projectTrackingService->getJobs()->where('jobs.is_active', true)->where('jobs.status', 'open')->get();

        return view('daily-task.create', [
            'jobs' => $jobs
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_number' => 'required|integer|exists:jobs,id',
            'description' => 'required|string',
            'date' => 'required',
            'hour' => 'required'
        ]);
        
        $data = [
            'job_number' => $request->input('job_number'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'hour' => $request->input('hour')
        ];

        try {
            $this->dailyTaskService->storeDailyTask($data);

            return redirect()->route('daily-task::detail', ['date' => $data['date']])->with('success', 'Daily Task successfully added');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }

    public function detail(Request $request, $date)
    {
        $dailyTaskByDate = $this->dailyTaskService->getDailyTaskByDate($date)->where('job_details.is_active', true);
        $total_hour = $this->dailyTaskService->getTotalHour($date);

        if ($request->ajax()) {
            return DataTables::of($dailyTaskByDate)
                ->addColumn('action', function($dailyTask) {
                    $urlEdit = route('daily-task::edit', ['jobDetailId' => $dailyTask->id]);
                    $urlDelete = route('daily-task::delete', ['jobDetailId' => $dailyTask->id]);
                    $name = $dailyTask->code . ' - ' . $dailyTask->description;

                    $action = '<a href="'.$urlEdit.'" class="btn btn-sm btn-info">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger btn-delete" data-url="'.$urlDelete.'"
                                    data-name="'.$name.'">
                                    Delete
                                </button>';

                    return $action;
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('daily-task.detail', [
            'date' => $date,
            'total_hour' => $total_hour
        ]);
    }

    public function edit($jobDetailId)
    {
        $dailyTask = $this->dailyTaskService->showJobDetail($jobDetailId);
        $jobs = $this->projectTrackingService->getJobs()->where('jobs.is_active', true)->where('jobs.status', 'open')->get();

        return view('daily-task.edit', [
            'daily_task' => $dailyTask,
            'jobs' => $jobs
        ]);
    }

    public function update(Request $request, $jobDetailId)
    {
        $request->validate([
            'job_number' => 'required|integer|exists:jobs,id',
            'description' => 'required|string',
            'date' => 'required',
            'hour' => 'required'
        ]);
        
        $data = [
            'job_number' => $request->input('job_number'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'hour' => $request->input('hour')
        ];

        try {
            $this->dailyTaskService->updateDailyTask($jobDetailId, $data);

            return redirect()->route('daily-task::detail', ['date' => $data['date']])->with('success', 'Daily Task successfully updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }

    public function delete($jobDetailId)
    {
        try {
            $this->dailyTaskService->deleteDailyTask($jobDetailId);

            return redirect()->back()->with('success', 'Daily Task successfully updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }
}
