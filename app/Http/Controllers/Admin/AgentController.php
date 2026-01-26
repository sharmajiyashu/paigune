<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAgentRequest;
use App\Http\Requests\Admin\UpdateAgentRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query_search  = $request->input('search');
        $change_status = $request->input('change_status');

        $agents = User::where('role', User::$agent)
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
            return view('admin.agents.pagination', compact('agents'))->render();
        }

        return view('admin.agents.index', compact('agents'));
    }


    public function create()
    {
        return view('admin.agents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgentRequest $request)
    {
        $data = $request->validated();
        $data['role'] = User::$agent;
        $data['password'] = Hash::make($request->password);
        $data['password_2'] = $request->password;

        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $filename = time() . '_' . $profile->getClientOriginalName(); // Unique filename

            $profile->move(public_path('storage'), $filename); // Move the file to a public directory
            $data['profile'] = $filename;
        }

        User::create($data);
        session()->flash('success', 'Agent Create Successfully');
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
        $agent = User::find($id);
        return view('admin.agents.create', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgentRequest $request, string $id)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        $data['password_2'] = $request->password;

        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $filename = time() . '_' . $profile->getClientOriginalName(); // Unique filename

            $profile->move(public_path('storage'), $filename); // Move the file to a public directory
            $data['profile'] = $filename;
        }
        User::where('id', $id)->update($data);
        session()->flash('success', 'Agent update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Agent Delete Successfully');
    }
}
