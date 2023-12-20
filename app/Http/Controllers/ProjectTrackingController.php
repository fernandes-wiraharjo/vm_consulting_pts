<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProjectTrackingService;
use App\Services\ClientService;
use App\Services\UserService;
use Yajra\DataTables\Facades\DataTables;

class ProjectTrackingController extends Controller
{
    public function __construct(
        private ProjectTrackingService $projectTrackingService,
        private ClientService $clientService,
        private UserService $userService,
    ) {}

    public function index(Request $request)
    {
        $jobs = $this->projectTrackingService->getJobs();

        if ($request->ajax()) {
            return DataTables::of($jobs)
                ->editColumn('status', function($job) {
                    if ($job->status === 'open') {
                        $badgeColor = 'bg-success';
                    } else {
                        $badgeColor = 'bg-danger';
                    }
                    return '<span class="badge '.$badgeColor.'">'.$job->status.'</span>';
                })
                ->editColumn('is_active', function($role) {
                    if ($role->is_active) {
                        return '<span class="badge bg-success">Active</span>';
                    } else {
                        return '<span class="badge bg-danger">Not Active</span>';
                    }
                })
                ->editColumn('total_costs', function($job) {
                    return formatCurrency($job->total_costs);
                })
                ->addColumn('action', function($job) {
                    $urlToggleActivate = route('project-tracking::toggleActivate', ['jobId' => $job->id]);
                    $urlDetail = route('project-tracking::detailPerJob', ['jobId' => $job->id]);
                    $urlEdit = route('project-tracking::edit', ['jobId' => $job->id]);

                    $textToggleActivate = 'Activate';
                    $btnToggleActivate = 'btn-success';
                    if ($job->is_active) {
                        $textToggleActivate = 'Deactive';
                        $btnToggleActivate = 'btn-danger';
                    }

                    $action = '<a href="'.$urlDetail.'" class="btn btn-sm btn-secondary">Detail</a>
                            <a href="'.$urlEdit.'" class="btn btn-sm btn-info">Edit</a>
                            <button type="button" class="btn btn-sm '.$btnToggleActivate.' btn-delete" 
                                data-name="'.$job->code.'" data-is-active="'.$job->is_active.'" 
                                data-url="'.$urlToggleActivate.'" data-btn-color="'.$btnToggleActivate.'">
                                '.$textToggleActivate.'
                            </button>';

                    return $action;
                })
                ->rawColumns(['status', 'is_active', 'action'])
                ->make();
        }

        return view('project-tracking.index');
    }

    public function create()
    {
        $clients = $this->clientService->getClients()->where('is_active', true)->get();

        return view('project-tracking.create', [
            'clients' => $clients
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'client' => 'required|integer|exists:clients,id',
            'job_number' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $data = [
            'id_client' => $request->input('client'),
            'code' => $request->input('job_number'),
            'description' => $request->input('description')
        ];

        try {
            $this->projectTrackingService->storeJob($data);

            return redirect()->route('project-tracking::index')->with('success', 'Project Tracking successfully added');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }

    public function edit($jobId)
    {
        $clients = $this->clientService->getClients()->where('is_active', true)->get();
        $job = $this->projectTrackingService->showJob($jobId);

        return view('project-tracking.edit', [
            'clients' => $clients,
            'job' => $job
        ]);
    }
    
    public function update(Request $request, $jobId)
    {
        $request->validate([
            'client' => 'required|integer|exists:clients,id',
            'job_number' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|string'
        ]);

        $data = [
            'id_client' => $request->input('client'),
            'code' => $request->input('job_number'),
            'description' => $request->input('description'),
            'status' => $request->input('status')
        ];

        try {
            $this->projectTrackingService->updateJob($jobId, $data);

            return redirect()->route('project-tracking::index')->with('success', 'Project Tracking successfully updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }

    public function detailPerJob(Request $request, $jobId)
    {
        $job = $this->projectTrackingService->showJob($jobId);
        $jobDetail = $this->projectTrackingService->getJobDetails($jobId)->where('job_details.is_active', true);

        if ($request->ajax()) {
            return DataTables::of($jobDetail)
                ->editColumn('total_cost', function($jobDetail) {
                    return formatCurrency($jobDetail->total_cost);
                })
                ->addColumn('action', function($jobDetail) use ($jobId) {
                    $urlDetail = route('project-tracking::detailPerUser', ['jobId' => $jobId, 'userId' => $jobDetail->user_id]);

                    $action = '<a href="'.$urlDetail.'" class="btn btn-sm btn-secondary">Detail</a>';

                    return $action;
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('project-tracking.detail.job', [
            'job' => $job
        ]);
    }

    public function detailPerUser(Request $request, $jobId, $userId)
    {
        $job = $this->projectTrackingService->showJob($jobId);
        $user = $this->userService->showUser($userId);
        $jobDetailPerUser = $this->projectTrackingService->getJobDetailsPerUser($jobId, $userId)->where('job_details.is_active', true);

        if ($request->startDate && $request->endDate) {
            $jobDetailPerUser->where('date', '>=', "$request->startDate")->where('date', '<=', "$request->endDate");
        }

        if ($request->ajax()) {
            return DataTables::of($jobDetailPerUser)
                ->editColumn('date', function($jobDetailPerUser) {
                    return date('D, d M Y', strtotime($jobDetailPerUser->date));
                })
                ->editColumn('rate_per_hour', function($jobDetailPerUser) {
                    return formatCurrency($jobDetailPerUser->rate_per_hour);
                })
                ->editColumn('cost', function($jobDetailPerUser) {
                    return formatCurrency($jobDetailPerUser->cost);
                })
                ->addColumn('action', function($jobDetailPerUser) use ($jobId, $userId) {
                    $urlEdit = route('project-tracking::editDetailPerUser', ['jobId' => $jobId, 'userId' => $userId, 'jobDetailId' => $jobDetailPerUser->id]);

                    $action = '<a href="'.$urlEdit.'" class="btn btn-sm btn-info">Edit</a>';

                    return $action;
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('project-tracking.detail.user', [
            'job' => $job,
            'user' => $user
        ]);
    }

    public function editDetailPerUser($jobId, $userId, $jobDetailId)
    {
        $job = $this->projectTrackingService->showJob($jobId);
        $user = $this->userService->showUser($userId);
        $jobDetail = $this->projectTrackingService->getJobDetailsPerUser($jobId, $userId)->where('id', $jobDetailId)->first();

        return view('project-tracking.detail.user-edit', [
            'job' => $job,
            'user' => $user,
            'job_detail' => $jobDetail
        ]);
    }

    public function updateDetailPerUser(Request $request, $jobId, $userId, $jobDetailId)
    {
        $request->validate([
            'rate_per_hour' => 'required|numeric',
            'cost' => 'required'
        ]);

        $data = [
            'rate_per_hour' => $request->input('rate_per_hour'),
            'cost' => str_replace('.', '', $request->input('cost'))
        ];

        try {
            $this->projectTrackingService->updateDetailPerUserJob($jobId, $userId, $jobDetailId, $data);

            return redirect()->route('project-tracking::detailPerUser', ['jobId' => $jobId, 'userId' => $userId])->with('success', 'Project Tracking successfully updated');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }

    public function toggleActivate($jobId)
    {
        try {
            $this->projectTrackingService->toggleActivateJob($jobId);

            return redirect()->route('project-tracking::index')->with('success', 'Project Tracking successfully updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }
}
