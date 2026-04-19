<?php

namespace App\Observers;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;

class AuditObserver
{
    public function created(Model $model): void
    {
        $this->log($model, 'CREATE');
    }

    public function updated(Model $model): void
    {
        if ($model->wasChanged()) {
            $this->log($model, 'UPDATE', $model->getOriginal());
        }
    }

    public function deleted(Model $model): void
    {
        $this->log($model, 'DELETE', $model->getOriginal());
    }

    protected function log(Model $model, string $action, ?array $oldData = null): void
    {
        $userId = auth()->id() ?? null;
        $ipAddress = request()->ip();

        AuditLog::create([
            'user_id' => $userId,
            'action' => $action,
            'table_name' => $model->getTable(),
            'record_id' => $model->id,
            'old_data' => $oldData,
            'new_data' => $action !== 'DELETE' ? $model->toArray() : null,
            'ip_address' => $ipAddress,
        ]);
    }
}