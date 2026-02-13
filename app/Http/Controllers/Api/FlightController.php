<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Airpot;
use App\Services\FlightAwareService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FlightController extends Controller
{

    public function __construct(private FlightAwareService $flightAware) {}


    public function airports(Request $request)
    {
        $query = Airpot::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            });
        }
        $airports = $query->get();
        return response()->json($airports);
    }

    public function arrivals(string $icao): JsonResponse
    {
        $data = $this->flightAware->getArrivals($icao);
        return response()->json($data);
    }

    public function departures(string $icao): JsonResponse
    {
        $data =  $this->flightAware->getDepartures($icao);
        return response()->json($data);
    }

    public function fromTo(string $from, string $to): JsonResponse
    {
        return response()->json(
            $this->flightAware->searchFlights($from, $to)
        );
    }
}
