<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    public static function bootLogsActivity()
    {
        static::created(function ($model) {
            self::logActivity($model, 'create', null, $model->toArray());
        });

        static::updated(function ($model) {
            self::logActivity($model, 'update', $model->getOriginal(), $model->getChanges());
        });

        static::deleted(function ($model) {
            self::logActivity($model, 'delete', $model->toArray(), null);
        });
    }

    protected static function logActivity($model, $action, $old, $new)
    {
        ActivityLog::create([
            'user_id'  => Auth::id(),
            'model'    => class_basename($model),
            'model_id' => $model->id,
            'action'   => $action,
            'old_data' => $old,
            'new_data' => $new,
            'ip'       => request()->ip(),
        ]);
    }
}

