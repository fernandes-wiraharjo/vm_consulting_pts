<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoleService;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function __construct(
        private RoleService $roleService,
    ) {}

    public function index(Request $request)
    {
        $roles = $this->roleService->getRoles();

        if ($request->ajax()) {
            return DataTables::of($roles)
                ->addColumn('action', function($role) {
                    $urlEdit = route('role::edit', ['roleId' => $role->id]);
                    $urlDelete = route('role::delete', ['roleId' => $role->id]);

                    $edit = '<a href="'.$urlEdit.'" type="button" class="btn btn-sm btn-secondary mb-2">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger mb-2 btn-delete" data-name="'.$role->name.'" data-url="'.$urlDelete.'">Delete</button>';

                    return $edit;
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('role.index');
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'name' => 'required|string'
        ]);

        $dataRole = [
            'code' => $request->input('code'),
            'name' => $request->input('name')
        ];

        try {
            $this->roleService->storeRole($dataRole);

            return redirect()->route('role::index')->with('success', 'Role successfully added');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }

    public function edit($roleId)
    {
        $role = $this->roleService->showRole($roleId);

        return view('role.edit', [
            'role' => $role
        ]);
    }

    public function update(Request $request, $roleId)
    {
        $request->validate([
            'code' => 'required|string',
            'name' => 'required|string'
        ]);

        $dataRole = [
            'code' => $request->input('code'),
            'name' => $request->input('name')
        ];

        try {
            $this->roleService->updateRole($roleId, $dataRole);

            return redirect()->route('role::index')->with('success', 'Role successfully updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }

    public function delete($roleId)
    {
        try {
            $this->roleService->deleteRole($roleId);

            return redirect()->route('role::index')->with('success', 'Role successfully deleted');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }
}
