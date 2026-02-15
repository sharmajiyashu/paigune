<?php

namespace App\Http\Controllers;

use App\Models\Airpot;
use App\Services\FlightAwareService;
use Illuminate\Http\JsonResponse;

class FlightAwareController extends Controller
{
    public function __construct(private FlightAwareService $flightAware) {}

    /**
     * Get info about a single airport by ICAO/IATA
     */

    public function airports(): JsonResponse
    {
        return response()->json(
            $this->flightAware->getAllAirports()
        );
    }

    public function airport(string $icao): JsonResponse
    {
        return response()->json(
            $this->flightAware->getAirport($icao)
        );
    }

    /**
     * Get departures from an airport
     */
    public function departures(string $icao): JsonResponse
    {
        return response()->json(
            $this->flightAware->getDepartures($icao)
        );
    }

    /**
     * Get arrivals at an airport
     */
    public function arrivals(string $icao): JsonResponse
    {
        return response()->json(
            $this->flightAware->getArrivals($icao)
        );
    }

    public function flight(string $ident): JsonResponse
    {
        return response()->json(
            $this->flightAware->getFlightDetail($ident)
        );
    }

    /**
     * Search flights from origin → destination
     */
    public function fromTo(string $from, string $to): JsonResponse
    {
        return response()->json(
            $this->flightAware->searchFlights($from, $to)
        );
    }

    /**
     * Get all international departures from VIDP
     */
    public function internationalDeparturesFromVIDP(): JsonResponse
    {
        $departures = $this->flightAware->getDepartures('VIDP');

        // Filter out domestic flights (India = IN)
        $international = collect($departures['flights'] ?? [])
            ->filter(fn($flight) => !in_array($flight['destination_country'] ?? null, ['IN']))
            ->values();

        return response()->json($international);
    }


    public function syncAirports(): JsonResponse
    {
        $allCodes = $this->flightAware->getAllAirports(); // [{code, info_url}, ...]

        $savedCount = 0;

        foreach ($allCodes as $airportSummary) {
            // $icao = $airportSummary['code'] ?? null;
            $icao = $airportSummary ?? null;

            if (!$icao) continue;

            // Fetch full details
            $details = $this->flightAware->getAirport($icao);

            if (!$details || empty($details['airport_code'])) {
                continue;
            }

            // Save or update in DB
            Airpot::updateOrCreate(
                ['code' => $details['airport_code']], // unique key
                [
                    'airport_code'       => $details['airport_code'] ?? null,
                    'alternate_ident'    => $details['alternate_ident'] ?? null,
                    'code_icao'          => $details['code_icao'] ?? null,
                    'code_iata'          => $details['code_iata'] ?? null,
                    'code_lid'           => $details['code_lid'] ?? null,
                    'name'               => $details['name'] ?? null,
                    'type'               => $details['type'] ?? null,
                    'elevation'          => $details['elevation'] ?? null,
                    'city'               => $details['city'] ?? null,
                    'state'              => $details['state'] ?? null,
                    'longitude'          => $details['longitude'] ?? null,
                    'latitude'           => $details['latitude'] ?? null,
                    'timezone'           => $details['timezone'] ?? null,
                    'country_code'       => $details['country_code'] ?? null,
                    'wiki_url'           => $details['wiki_url'] ?? null,
                    'airport_flights_url' => $details['airport_flights_url'] ?? null,
                    'alternatives'       => !empty($details['alternatives']) ? json_encode($details['alternatives']) : null,
                    'status'             => 1, // active by default
                ]
            );

            $savedCount++;
        }

        return response()->json([
            'success' => true,
            'saved_airports' => $savedCount,
        ]);
    }
}
