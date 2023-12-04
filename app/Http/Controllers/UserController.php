<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Services\UserService;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService,
        private RoleService $roleService,
    ) {}

    public function index(Request $request)
    {
        $users = $this->userService->getUsers();

        if ($request->ajax()) {
            return DataTables::of($users)
                ->editColumn('is_active', function($user) {
                    if ($user->is_active) {
                        return '<span class="badge bg-success">Active</span>';
                    } else {
                        return '<span class="badge bg-danger">Not Active</span>';
                    }
                })
                ->addColumn('action', function($user) {
                    $urlEdit = route('user::edit', ['userId' => $user->id]);
                    $urlToggleActivate = route('user::toggleActivate', ['userId' => $user->id]);

                    $textToggleActivate = 'Activate';
                    $btnToggleActivate = 'btn-success';
                    if ($user->is_active) {
                        $textToggleActivate = 'Deactive';
                        $btnToggleActivate = 'btn-danger';
                    }

                    $edit = '<a href="'.$urlEdit.'" type="button" class="btn btn-sm btn-info mb-2">Edit</a>
                            <button type="button" class="btn btn-sm '.$btnToggleActivate.' mb-2 btn-delete" 
                                data-name="'.$user->name.'" data-is-active="'.$user->is_active.'" 
                                data-url="'.$urlToggleActivate.'" data-btn-color="'.$btnToggleActivate.'">
                                '.$textToggleActivate.'
                            </button>';

                    return $edit;
                })
                ->rawColumns(['is_active', 'action'])
                ->make();
        }

        return view('user.index');
    }

    public function create()
    {
        $roles = $this->roleService->getRoles()->where('is_active', true)->get();

        return view('user.create', [
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|integer|exists:roles,id',
            'name' => 'required|string',
            'user_name' => 'required|string',
            'password' => 'required|string'
        ]);

        $dataUser = [
            'id_role' => $request->input('role'),
            'name' => $request->input('name'),
            'user_name' => $request->input('user_name'),
            'password' => $request->input('password')
        ];

        try {
            $this->userService->storeUser($dataUser);

            return redirect()->route('user::index')->with('success', 'User successfully added');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }

    public function edit($userId)
    {
        $user = $this->userService->showUser($userId);
        $roles = $this->roleService->getRoles()->where('is_active', true)->get();

        return view('user.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, $userId)
    {
        $request->validate([
            'role' => 'required|integer|exists:roles,id',
            'name' => 'required|string',
            'user_name' => 'required|string',
            'password' => 'nullable'
        ]);

        $dataUser = [
            'id_role' => $request->input('role'),
            'name' => $request->input('name'),
            'user_name' => $request->input('user_name'),
            'password' => $request->input('password')
        ];

        try {
            $this->userService->updateUser($userId, $dataUser);

            return redirect()->route('user::index')->with('success', 'User successfully updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }

    public function toggleActivate($userId)
    {
        try {
            $this->userService->toggleActivateUser($userId);

            return redirect()->route('user::index')->with('success', 'User successfully updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }
}
