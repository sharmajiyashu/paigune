<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = ['client_id', 'reference_number', 'internal_ref', 'total_price', 'notes'];

    public function flight()
    {
        return $this->hasOne(QuoteFlight::class);
    }

    public function hotel()
    {
        return $this->hasOne(QuoteHotel::class);
    }

    public function transport()
    {
        return $this->hasOne(QuoteTransport::class);
    }

    public function other()
    {
        return $this->hasOne(QuoteOther::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
