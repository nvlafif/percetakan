@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Audit Log Details</h1>
        <a href="{{ route('admin.audit-logs.index') }}" class="text-blue-600 hover:text-blue-900">Back to Audit Logs</a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <dt class="text-sm font-medium text-gray-500">User</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $auditLog->user->name ?? 'System' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Action</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $auditLog->action }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Table</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $auditLog->table_name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Record ID</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $auditLog->record_id }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Date</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $auditLog->created_at->format('d/m/Y H:i:s') }}</dd>
            </div>
        </dl>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Old Values</h2>
        <pre class="bg-gray-50 p-4 rounded-lg overflow-x-auto text-sm">{{ json_encode(json_decode($auditLog->old_values ?? '{}'), JSON_PRETTY_PRINT) }}</pre>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">New Values</h2>
        <pre class="bg-gray-50 p-4 rounded-lg overflow-x-auto text-sm">{{ json_encode(json_decode($auditLog->new_values ?? '{}'), JSON_PRETTY_PRINT) }}</pre>
    </div>
</div>
@endsection