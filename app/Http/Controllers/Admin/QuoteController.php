<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQuoteFlightRequest;
use App\Http\Requests\StoreQuoteHotelRequest;
use App\Http\Requests\StoreQuoteOtherRequest;
use App\Http\Requests\StoreQuoteRequest;
use App\Http\Requests\StoreQuoteTransportRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Models\Notification;
use App\Models\Quote;
use App\Models\QuoteFlight;
use App\Models\QuoteHotel;
use App\Models\QuoteOther;
use App\Models\QuoteTransport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $change_status = $request->input('change_status');

        // Start query with relationships (client)
        $quotes = Quote::with('client') // eager load client
            ->when($search, function ($query, $search) {
                $query->whereHas('client', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('mobile', 'like', '%' . $search . '%');
                });
            })
            ->when($change_status, function ($query, $change_status) {
                // Assuming you have a status column
                $query->where('status', $change_status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString(); // keep query params on pagination


        // Handle AJAX requests for pagination
        if ($request->ajax()) {
            return view('admin.quotes.pagination', compact('quotes'))->render();
        }

        return view('admin.quotes.index', compact('quotes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = User::where('role', User::$client)->get();
        return view('admin.quotes.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuoteRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();
        $quote = Quote::create($data);

        Notification::create([
            'type' => 'quote',
            'title' => 'New Quote Created',
            'message' => 'Quote #' . $quote->reference_number . ' has been created.',
            'from_user_id' => Auth::id(),
            // 'to_user_id' => $adminId,
            'reference_id' => $quote->id
        ]);


        session()->flash('success', 'Quote Basic Detail Save');
        return route('admin.quotes.flights', $quote->id);
    }

    public function flightUpdate(StoreQuoteFlightRequest $request)
    {
        QuoteFlight::updateOrCreate(
            ['quote_id' => $request->quote_id],   // where condition
            $request->validated()      // data to insert/update
        );
        session()->flash('success', 'Quote Flight Detail Save');
        return route('admin.quotes.hotels', $request->quote_id);
    }

    public function hotelUpdate(StoreQuoteHotelRequest $request)
    {
        QuoteHotel::updateOrCreate(
            ['quote_id' => $request->quote_id],   // where condition
            $request->validated()      // data to insert/update
        );
        session()->flash('success', 'Quote Hotel Detail Save');
        return route('admin.quotes.transports', $request->quote_id);
    }

    public function transportUpdate(StoreQuoteTransportRequest $request)
    {
        QuoteTransport::updateOrCreate(
            ['quote_id' => $request->quote_id],   // where condition
            $request->validated()      // data to insert/update
        );
        session()->flash('success', 'Quote Transport Detail Save');
        return route('admin.quotes.others', $request->quote_id);
    }

    public function otherUpdate(StoreQuoteOtherRequest $request)
    {
        QuoteOther::updateOrCreate(
            ['quote_id' => $request->quote_id],   // where condition
            $request->validated()      // data to insert/update
        );
        session()->flash('success', 'Quote Other Detail Save');
        return route('admin.quotes.show', $request->quote_id);
    }

    public function flights($id)
    {
        $quote = Quote::find($id);
        $flight = QuoteFlight::where('quote_id', $id)->first();
        return view('admin.quotes.flights', compact('quote', 'flight'));
    }

    public function hotels($id)
    {
        $quote = Quote::find($id);
        $hotel = QuoteHotel::where('quote_id', $id)->first();
        return view('admin.quotes.hotels', compact('quote', 'hotel'));
    }

    public function transports($id)
    {
        $quote = Quote::find($id);
        $transport = QuoteTransport::where('quote_id', $id)->first();
        return view('admin.quotes.transports', compact('quote', 'transport'));
    }

    public function others($id)
    {
        $quote = Quote::find($id);
        $other = QuoteOther::where('quote_id', $id)->first();
        return view('admin.quotes.others', compact('quote', 'other'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $quote = Quote::with([
            'client',
            'flight',
            'hotel',
            'transport',
            'other'
        ])->findOrFail($id);

        return view('admin.quotes.show', compact('quote'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $clients = User::where('role', User::$client)->get();
        $quote = Quote::find($id);
        return view('admin.quotes.create', compact('clients', 'quote'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuoteRequest $request, string $id)
    {
        Quote::where('id', $id)->update($request->validated());
        session()->flash('success', 'Quote Basic Detail Save');
        return route('admin.quotes.flights', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
