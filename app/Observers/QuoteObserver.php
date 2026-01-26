<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Quote;
use Illuminate\Support\Facades\Auth;

class QuoteObserver
{
    /**
     * Handle the Quote "created" event.
     */
    public function created(Quote $quote): void
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'model' => 'Quote',
            'model_id' => $quote->id,
            'action' => 'create',
            'new_data' => $quote->toArray(),
            'ip' => request()->ip()
        ]);
    }

    /**
     * Handle the Quote "updated" event.
     */
    public function updated(Quote $quote): void
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'model' => 'Quote',
            'model_id' => $quote->id,
            'action' => 'update',
            'old_data' => $quote->getOriginal(),
            'new_data' => $quote->getChanges(),
            'ip' => request()->ip()
        ]);
    }

    /**
     * Handle the Quote "deleted" event.
     */
    public function deleted(Quote $quote): void
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'model' => 'Quote',
            'model_id' => $quote->id,
            'action' => 'delete',
            'old_data' => $quote->toArray(),
            'ip' => request()->ip()
        ]);
    }

    /**
     * Handle the Quote "restored" event.
     */
    public function restored(Quote $quote): void
    {
        //
    }

    /**
     * Handle the Quote "force deleted" event.
     */
    public function forceDeleted(Quote $quote): void
    {
        //
    }
}
