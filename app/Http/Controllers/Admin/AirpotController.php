<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAirpotRequest;
use App\Http\Requests\Admin\UpdateAirpotRequest;
use App\Models\Airpot;
use Illuminate\Http\Request;

class AirpotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query_search  = $request->input('search');
        $change_status = $request->input('change_status');

        $airpots = Airpot::when($query_search, function ($query) use ($query_search) {
            $query->where(function ($q) use ($query_search) {
                $q->where('name', 'like', '%' . $query_search . '%')
                    ->orWhere('code', 'like', '%' . $query_search . '%')
                    ->orWhere('city_code', 'like', '%' . $query_search . '%');
            });
        })
            ->when($change_status !== null, function ($query) use ($change_status) {
                $query->where('status', $change_status);
            })
            ->latest()
            ->paginate(10);

        if ($request->ajax()) {
            return view('admin.airpots.pagination', compact('airpots'))->render();
        }

        return view('admin.airpots.index', compact('airpots'));
    }

    public function create()
    {
        return view('admin.airpots.create');
    }

    public function store(StoreAirpotRequest $request)
    {
        Airpot::create($request->validated());
        session()->flash('success', 'Airpot created successfully');
    }

    public function edit(string $id)
    {
        $airpot = Airpot::findOrFail($id);
        return view('admin.airpots.create', compact('airpot'));
    }

    public function update(UpdateAirpotRequest $request, string $id)
    {
        Airpot::where('id', $id)->update($request->validated());
        session()->flash('success', 'Airpot updated successfully');
    }

    public function destroy(string $id)
    {
        Airpot::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Airpot deleted successfully');
    }
}
