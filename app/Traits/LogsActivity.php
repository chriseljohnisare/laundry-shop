<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        static::created(function ($model) {
            $model->logActivity('created');
        });

        static::updated(function ($model) {
            $model->logActivity('updated');
        });

        static::deleted(function ($model) {
            $model->logActivity('deleted');
        });
    }

    public function logActivity($action, $description = null)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'subject_type' => get_class($this),
            'subject_id' => $this->id,
            'description' => $description ?? "{$action} " . class_basename($this) . " #{$this->id}",
            'properties' => $action === 'updated' ? [
                'old' => array_intersect_key($this->getOriginal(), $this->getDirty()),
                'new' => $this->getDirty(),
            ] : $this->toArray(),
        ]);
    }
}
