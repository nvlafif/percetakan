@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold text-gray-800">Audit Logs</h1>

    <div class="bg-white rounded-lg shadow p-4">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">User</label>
                <input type="text" name="user_id" value="{{ request('user_id') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2" placeholder="User ID">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Action</label>
                <select name="action" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
                    <option value="">All</option>
                    <option value="create" {{ request('action') == 'create' ? 'selected' : '' }}>Create</option>
                    <option value="update" {{ request('action') == 'update' ? 'selected' : '' }}>Update</option>
                    <option value="delete" {{ request('action') == 'delete' ? 'selected' : '' }}>Delete</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Table</label>
                <input type="text" name="table_name" value="{{ request('table_name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2" placeholder="Table name">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">From Date</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">To Date</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
            </div>
            <div class="md:col-span-5">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Filter</button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Table</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Record ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Details</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($logs as $log)
                <tr>
                    <td class="px-6 py-4">{{ $log->user->name ?? 'System' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full 
                            {{ $log->action === 'create' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $log->action === 'update' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $log->action === 'delete' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ $log->action }}
                        </span>
                    </td>
                    <td class="px-6 py-4">{{ $log->table_name }}</td>
                    <td class="px-6 py-4">{{ $log->record_id }}</td>
                    <td class="px-6 py-4">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.audit-logs.show', $log->id) }}" class="text-blue-600 hover:text-blue-900">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $logs->links() }}</div>
</div>
@endsection