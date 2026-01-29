<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'type',
        'title',
        'message',
        'from_user_id',
        'to_user_id',
        'reference_id',
        'is_read'
    ];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }
}
