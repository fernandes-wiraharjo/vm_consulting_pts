<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClientService;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    public function __construct(
        private ClientService $clientService,
    ) {}

    public function index(Request $request)
    {
        $clients = $this->clientService->getClients();

        if ($request->ajax()) {
            return DataTables::of($clients)
                ->editColumn('is_active', function($client) {
                    if ($client->is_active) {
                        return '<span class="badge bg-success">Active</span>';
                    } else {
                        return '<span class="badge bg-danger">Not Active</span>';
                    }
                })
                ->addColumn('action', function($client) {
                    $urlDetail = route('client::detail', ['clientId' => $client->id]);
                    $urlEdit = route('client::edit', ['clientId' => $client->id]);
                    $urlToggleActivate = route('client::toggleActivate', ['clientId' => $client->id]);

                    $textToggleActivate = 'Activate';
                    $btnToggleActivate = 'btn-success';
                    if ($client->is_active) {
                        $textToggleActivate = 'Deactive';
                        $btnToggleActivate = 'btn-danger';
                    }

                    $edit = '<a href="'.$urlDetail.'" type="button" class="btn btn-sm btn-secondary mb-2">Detail</a>
                            <a href="'.$urlEdit.'" type="button" class="btn btn-sm btn-info mb-2">Edit</a>
                            <button type="button" class="btn btn-sm '.$btnToggleActivate.' mb-2 btn-delete" 
                                data-name="'.$client->name.'" data-is-active="'.$client->is_active.'" 
                                data-url="'.$urlToggleActivate.'" data-btn-color="'.$btnToggleActivate.'">
                                '.$textToggleActivate.'
                            </button>';

                    return $edit;
                })
                ->rawColumns(['is_active', 'action'])
                ->make();
        }

        return view('client.index');
    }

    public function create()
    {
        return view('client.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'name' => 'required|string'
        ]);

        $dataClient = [
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'pic' => $request->input('pic'),
            'address' => $request->input('address'),
            'description' => $request->input('description')
        ];

        try {
            $this->clientService->storeClient($dataClient);

            return redirect()->route('client::index')->with('success', 'Client successfully added');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }

    public function detail($clientId)
    {
        $client = $this->clientService->showClient($clientId);

        return view('client.detail', [
            'client' => $client
        ]);
    }

    public function edit($clientId)
    {
        $client = $this->clientService->showClient($clientId);

        return view('client.edit', [
            'client' => $client
        ]);
    }

    public function update(Request $request, $clientId)
    {
        $request->validate([
            'code' => 'required|string',
            'name' => 'required|string'
        ]);

        $dataClient = [
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'pic' => $request->input('pic'),
            'address' => $request->input('address'),
            'description' => $request->input('description')
        ];

        try {
            $this->clientService->updateClient($clientId, $dataClient);

            return redirect()->route('client::index')->with('success', 'Client successfully updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }

    public function toggleActivate($clientId)
    {
        try {
            $this->clientService->toggleActivateClient($clientId);

            return redirect()->route('client::index')->with('success', 'Client successfully updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }
}
