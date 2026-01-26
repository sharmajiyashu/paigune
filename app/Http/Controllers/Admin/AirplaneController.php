<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAirplaneRequest;
use App\Http\Requests\Admin\UpdateAirplaneRequest;
use App\Models\Airplane;
use Illuminate\Http\Request;

class AirplaneController extends Controller
{
    public function index(Request $request)
    {
        $query_search  = $request->input('search');
        $change_status = $request->input('change_status');

        $airplanes = Airplane::when($query_search, function ($query) use ($query_search) {
            $query->where(function ($q) use ($query_search) {
                $q->where('airline_operator', 'like', '%' . $query_search . '%')
                    ->orWhere('airplane_type', 'like', '%' . $query_search . '%')
                    ->orWhere('flight_number', 'like', '%' . $query_search . '%');
            });
        })
            ->when($change_status !== null, function ($query) use ($change_status) {
                $query->where('status', $change_status);
            })
            ->latest()
            ->paginate(10);

        if ($request->ajax()) {
            return view('admin.airplanes.pagination', compact('airplanes'))->render();
        }

        return view('admin.airplanes.index', compact('airplanes'));
    }

    public function create()
    {
        return view('admin.airplanes.create');
    }

    public function store(StoreAirplaneRequest $request)
    {
        Airplane::create($request->validated());
        session()->flash('success', 'Airplane created successfully');
    }

    public function edit(string $id)
    {
        $airplane = Airplane::findOrFail($id);
        return view('admin.airplanes.create', compact('airplane'));
    }

    public function update(UpdateAirplaneRequest $request, string $id)
    {
        Airplane::where('id', $id)->update($request->validated());
        session()->flash('success', 'Airplane updated successfully');
    }

    public function destroy(string $id)
    {
        Airplane::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Airplane deleted successfully');
    }
}
