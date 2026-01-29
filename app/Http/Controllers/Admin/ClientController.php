<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientRequest;
use App\Http\Requests\Admin\UpdateClientRequest;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query_search  = $request->input('search');
        $change_status = $request->input('change_status');

        $clients = User::where('role', User::$client)
            ->when($query_search, function ($query) use ($query_search) {
                $query->where(function ($q) use ($query_search) {
                    $q->where('name', 'like', '%' . $query_search . '%')
                        ->orWhere('email', 'like', '%' . $query_search . '%')
                        ->orWhere('mobile', 'like', '%' . $query_search . '%');
                });
            })
            ->latest()
            ->paginate(10);

        if ($request->ajax()) {
            return view('admin.clients.pagination', compact('clients'))->render();
        }

        return view('admin.clients.index', compact('clients'));
    }


    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        $data = $request->validated();
        $data['role'] = User::$client;
        $data['password'] = Hash::make('123456');
        $data['password_2'] = 123456;
        $client = User::create($data);

        Notification::create([
            'type' => 'client',
            'title' => 'New Client Created',
            'message' => 'Client ' . $client->name . ' has been added by ' . Auth::user()->name,
            'from_user_id' => Auth::id(),
            'to_user_id' => 1, // Admin ID
            'reference_id' => $client->id
        ]);

        session()->flash('success', 'Client Create Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = User::find($id);
        return view('admin.clients.create', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, string $id)
    {
        $data = $request->validated();
        User::where('id', $id)->update($data);
        session()->flash('success', 'Client update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Client Delete Successfully');
    }
}
