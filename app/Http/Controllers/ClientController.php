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
                    $urlDelete = route('client::delete', ['clientId' => $client->id]);

                    $edit = '<a href="'.$urlDetail.'" type="button" class="btn btn-sm btn-secondary">Detail</a>
                            <a href="'.$urlEdit.'" type="button" class="btn btn-sm btn-info">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger btn-delete" data-url="'.$urlDelete.'"
                                data-name="'.$client->name.'">
                                Delete
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
            'description' => $request->input('description'),
            'is_active' => $request->input('is_active') == 'on' ? true : false
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

    public function delete($clientId)
    {
        try {
            $deleteClient = $this->clientService->deleteClient($clientId);

            if ($deleteClient) {
                return redirect()->back()->with('success', 'Client successfully deleted');
            } else {
                return redirect()->back()->with('failed', 'Cannot delete client as it has associated Project Tracking');
            }

        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('failed', 'An error occurred');
        }
    }
}
