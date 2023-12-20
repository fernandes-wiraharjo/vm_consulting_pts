<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PositionService;
use Yajra\DataTables\Facades\DataTables;

class PositionController extends Controller
{
    public function __construct(
        private PositionService $positionService,
    ) {}

    public function index(Request $request)
    {
        $positions = $this->positionService->getPositions();

        if ($request->ajax()) {
            return DataTables::of($positions)
                ->editColumn('is_active', function($position) {
                    if ($position->is_active) {
                        return '<span class="badge bg-success">Active</span>';
                    } else {
                        return '<span class="badge bg-danger">Not Active</span>';
                    }
                })
                ->addColumn('action', function($position) {
                    $urlEdit = route('position::edit', ['positionId' => $position->id]);
                    $urlToggleActivate = route('position::toggleActivate', ['positionId' => $position->id]);

                    $textToggleActivate = 'Activate';
                    $btnToggleActivate = 'btn-success';
                    if ($position->is_active) {
                        $textToggleActivate = 'Deactive';
                        $btnToggleActivate = 'btn-danger';
                    }

                    $edit = '<a href="'.$urlEdit.'" type="button" class="btn btn-sm btn-info mb-2">Edit</a>
                            <button type="button" class="btn btn-sm '.$btnToggleActivate.' mb-2 btn-delete" 
                                data-name="'.$position->name.'" data-is-active="'.$position->is_active.'" 
                                data-url="'.$urlToggleActivate.'" data-btn-color="'.$btnToggleActivate.'">
                                '.$textToggleActivate.'
                            </button>';

                    return $edit;
                })
                ->rawColumns(['is_active', 'action'])
                ->make();
        }

        return view('position.index');
    }

    public function create()
    {
        return view('position.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'name' => 'required|string'
        ]);

        $dataPosition = [
            'code' => $request->input('code'),
            'name' => $request->input('name')
        ];

        try {
            $this->positionService->storePosition($dataPosition);

            return redirect()->route('position::index')->with('success', 'Position successfully added');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }

    public function edit($positionId)
    {
        $position = $this->positionService->showPosition($positionId);

        return view('position.edit', [
            'position' => $position
        ]);
    }

    public function update(Request $request, $positionId)
    {
        $request->validate([
            'code' => 'required|string',
            'name' => 'required|string'
        ]);

        $dataPosition = [
            'code' => $request->input('code'),
            'name' => $request->input('name')
        ];

        try {
            $this->positionService->updatePosition($positionId, $dataPosition);

            return redirect()->route('position::index')->with('success', 'Position successfully updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }

    public function toggleActivate($positionId)
    {
        try {
            $this->positionService->toggleActivatePosition($positionId);

            return redirect()->route('position::index')->with('success', 'Position successfully updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }
}
