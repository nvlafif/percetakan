@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Employee</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" value="{{ $employee->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Position</label>
                    <input type="text" name="position" value="{{ $employee->position }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" value="{{ $employee->phone }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ $employee->email }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Hire Date</label>
                    <input type="date" name="hire_date" value="{{ $employee->hire_date }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Salary</label>
                    <input type="number" name="salary" value="{{ $employee->salary }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2" required>
                        <option value="active" {{ $employee->status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $employee->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="terminated" {{ $employee->status === 'terminated' ? 'selected' : '' }}>Terminated</option>
                    </select>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Update</button>
                <a href="{{ route('admin.employees.index') }}" class="ml-2 text-gray-600 hover:text-gray-900">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection