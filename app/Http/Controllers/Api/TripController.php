<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    public function trips()
    {
        $userId = Auth::user()->id;

        $quotes = Quote::where('client_id', $userId)
            ->where('status', 'accepted')
            ->with(['client', 'flight', 'hotel', 'transport', 'other'])
            ->latest()
            ->get();

        $upcoming = [];
        $past = [];

        foreach ($quotes as $quote) {
            if ($quote->flight) {
                // Decode flight_json if needed
                if (isset($quote->flight->flight_json) && is_string($quote->flight->flight_json)) {
                    $quote->flight->flight_json = json_decode($quote->flight->flight_json);
                }

                // Combine departure_date and departure_time into Carbon datetime
                $departureDateTime = Carbon::parse($quote->flight->departure_date . ' ' . $quote->flight->departure_time);

                if ($departureDateTime->isFuture()) {
                    $upcoming[] = $quote;
                } else {
                    $past[] = $quote;
                }
            } else {
                // If no flight, consider as past or skip
                $past[] = $quote;
            }
        }

        return response()->json([
            'upcoming_trips' => $upcoming,
            'past_trips' => $past,
        ]);
    }
}
