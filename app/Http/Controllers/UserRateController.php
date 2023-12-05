<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\UserRateService;
use Yajra\DataTables\Facades\DataTables;

class UserRateController extends Controller
{
    public function __construct(
        private UserService $userService,
        private UserRateService $userRateService,
    ) {}

    public function index(Request $request)
    {
        $userRates = $this->userRateService->getUserRates();

        if ($request->ajax()) {
            return DataTables::of($userRates)
                ->editColumn('default_rate_per_hour', function($userRate) {
                    return formatCurrency($userRate->default_rate_per_hour);
                })
                ->editColumn('is_active', function($userRate) {
                    if ($userRate->is_active) {
                        return '<span class="badge bg-success">Active</span>';
                    } else {
                        return '<span class="badge bg-danger">Not Active</span>';
                    }
                })
                ->addColumn('action', function($userRate) {
                    $urlEdit = route('user-rate::edit', ['userRateId' => $userRate->id]);
                    $urlToggleActivate = route('user-rate::toggleActivate', ['userRateId' => $userRate->id]);

                    $textToggleActivate = 'Activate';
                    $btnToggleActivate = 'btn-success';
                    if ($userRate->is_active) {
                        $textToggleActivate = 'Deactive';
                        $btnToggleActivate = 'btn-danger';
                    }

                    $name = $userRate->name . ' - ' . formatCurrency($userRate->default_rate_per_hour);
                    $edit = '<a href="'.$urlEdit.'" type="button" class="btn btn-sm btn-info mb-2">Edit</a>
                            <button type="button" class="btn btn-sm '.$btnToggleActivate.' mb-2 btn-delete" 
                                data-name="'.$name.'" data-is-active="'.$userRate->is_active.'" 
                                data-url="'.$urlToggleActivate.'" data-btn-color="'.$btnToggleActivate.'">
                                '.$textToggleActivate.'
                            </button>';

                    return $edit;
                })
                ->rawColumns(['is_active', 'action'])
                ->make();
        }

        return view('user-rate.index');
    }

    public function create()
    {
        $users = $this->userService->getUsers()->where('users.is_active', true)->get();

        return view('user-rate.create', [
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required|integer|exists:users,id',
            'rate_per_hour' => 'required|numeric',
        ]);

        $dataUserRate = [
            'id_user' => $request->input('user'),
            'rate_per_hour' => $request->input('rate_per_hour')
        ];

        try {
            $this->userRateService->storeUserRate($dataUserRate);

            return redirect()->route('user-rate::index')->with('success', 'User Rate successfully added');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }

    public function edit($userRateId)
    {
        $users = $this->userService->getUsers()->where('users.is_active', true)->get();
        $userRate = $this->userRateService->showUserRate($userRateId);

        return view('user-rate.edit', [
            'users' => $users,
            'user_rate' => $userRate
        ]);
    }

    public function update(Request $request, $userRateId)
    {
        $request->validate([
            'user' => 'required|integer|exists:users,id',
            'rate_per_hour' => 'required|numeric',
        ]);

        $dataUserRate = [
            'id_user' => $request->input('user'),
            'rate_per_hour' => $request->input('rate_per_hour')
        ];

        try {
            $this->userRateService->updateUserRate($userRateId, $dataUserRate);

            return redirect()->route('user-rate::index')->with('success', 'User Rate successfully updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }

    public function toggleActivate($userRateId)
    {
        try {
            $this->userRateService->toggleActivateUserRate($userRateId);

            return redirect()->route('user-rate::index')->with('success', 'User Rate successfully updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }
}
