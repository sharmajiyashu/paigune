<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    public function getData(Request $request)
    {
        $userId = Auth::user()->id;
        $quotes = Quote::where('client_id', $userId)->where('status', 'pending')->latest()->get();
        return response()->json($quotes);
    }

    public function getDetail(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $quote = Quote::with([
            'client',
            'flight',
            'hotel',
            'transport',
            'other'
        ])->findOrFail($id);
        return response()->json($quote);
    }


    public function delete(Request $request, $id)
    {
        $userId = Auth::user()->id;
        Quote::where('id', $id)->where('client_id', $userId)->delete();
        return response()->json([
            "message" => "Delete Quote Successfully",
        ]);
    }


    public function changeStatus(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $request->validate([
            'status' => 'required|string|in:accepted,rejected',
        ]);
        $quote = Quote::where('id', $id)
            ->where('client_id', $userId)
            ->first();

        if (!$quote) {
            return response()->json([
                'message' => 'Quote not found'
            ], 404);
        }
        $quote->status = $request->status;
        $quote->save();

        return response()->json([
            'message' => 'Quote status updated successfully',
            'status' => $quote->status
        ]);
    }
}
