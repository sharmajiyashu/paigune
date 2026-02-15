<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class FlightAwareService
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.flightaware.base_url');
        $this->apiKey  = config('services.flightaware.api_key');
    }

    /**
     * Make GET request to FlightAware AeroAPI
     */
    protected function request(string $endpoint, array $params = [])
    {
        $response = Http::withHeaders([
            'x-apikey' => $this->apiKey,
            'Accept'   => 'application/json',
        ])->get($this->baseUrl . $endpoint, $params);

        if (!$response->successful()) {
            return [
                'error' => true,
                'status' => $response->status(),
                'message' => $response->body(),
            ];
        }

        return $response->json();
    }

    /**
     * Get info about an airport by ICAO/IATA code
     */

    public function getAllAirports(): array
    {
        return Cache::remember('fa_all_airports', now()->addMinutes(30), function () {
            $allAirports = [];
            $seenCodes = [];
            $nextPage = 1;

            do {
                $response = $this->request('/airports', ['page' => $nextPage, 'max_pages' => 1]);

                return $response;

                if (!empty($response['airports'])) {
                    foreach ($response['airports'] as $airport) {
                        $code = $airport['code'] ?? null;

                        // skip duplicates
                        if ($code && !in_array($code, $seenCodes)) {
                            $allAirports[] = [
                                'code' => $code,
                                'info_url' => $airport['airport_info_url'] ?? null
                            ];
                            $seenCodes[] = $code;
                        }
                    }
                }

                $nextPage = isset($response['links']['next']) ? $response['links']['next'] : null;
            } while ($nextPage);

            return $allAirports;
        });
    }

    public function getAirport(string $icao)
    {
        return Cache::remember("fa_airport_$icao", now()->addMinutes(30), function () use ($icao) {
            return $this->request("/airports/$icao");
        });
    }

    /**
     * Get departures from an airport
     */
    public function getDepartures(string $icao)
    {
        return Cache::remember("fa_departures_$icao", now()->addMinutes(30), function () use ($icao) {
            return $this->request("/airports/$icao/flights/departures");
        });
    }

    /**
     * Get arrivals at an airport
     */
    public function getArrivals(string $icao)
    {
        return Cache::remember("fa_arrivals_$icao", now()->addMinutes(30), function () use ($icao) {
            return $this->request("/airports/$icao/flights/arrivals");
        });
    }

    /**
     * Search flights from origin → destination
     */
    public function searchFlights(string $from, string $to): array
    {
        $cacheKey = "fa_flights_all_{$from}_to_{$to}";

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($from, $to) {

            $endpoint = $this->baseUrl . '/flights/search';
            $query = "-origin {$from} -destination {$to}";

            $allFlights = [];
            $nextUrl = null;

            do {

                $response = Http::withHeaders([
                    'x-apikey' => $this->apiKey,
                    'Accept'   => 'application/json',
                ])->get($nextUrl ?? $endpoint, [
                    'query' => $nextUrl ? null : $query,
                    'max_pages' => 1,
                ]);

                if ($response->failed()) {
                    return [
                        'error'   => true,
                        'status'  => $response->status(),
                        'message' => $response->body(),
                    ];
                }

                $data = $response->json();

                if (isset($data['flights'])) {
                    $allFlights = array_merge($allFlights, $data['flights']);
                }

                $nextUrl = $data['links']['next'] ?? null;
            } while ($nextUrl);

            return [
                'total_flights' => count($allFlights),
                'flights'       => $allFlights,
            ];
        });
    }
}
