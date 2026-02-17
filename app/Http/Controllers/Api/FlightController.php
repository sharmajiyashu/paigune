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

    public function searchByFlightAndDate(Request $request)
    {
        $request->validate([
            'flight_number' => 'required|string',
            'departure_date' => 'required|date',
        ]);

        $flightNumber = $request->flight_number;
        $departureDate = $request->departure_date; // e.g., "2026-02-19"

        // Call FlightAware API
        $result = $this->flightAware->getFlightDetail($flightNumber);

        if (!isset($result['flight']) && !isset($result['flights'])) {
            return response()->json([
                'flight' => null,
                'error' => $result['error'] ?? 'No flight data returned'
            ]);
        }

        $flights = $result['flights'] ?? [$result['flight']];

        // Filter by departure_date (scheduled_out)
        $filtered = array_filter($flights, function ($flight) use ($departureDate) {
            $flightDate = substr($flight['scheduled_out'], 0, 10); // "YYYY-MM-DD"
            return $flightDate === $departureDate;
        });

        if (empty($filtered)) {
            return response()->json([
                'flight' => null,
                'error' => 'No flight found for this date'
            ]);
        }

        // Take the first matching flight
        $flight = array_values($filtered)[0];

        return response()->json([
            'flight' => $flight
        ]);
    }
}
