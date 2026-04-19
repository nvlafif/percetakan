@extends('layouts.kasir')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Kasir Dashboard</h1>
        <a href="{{ route('kasir.transactions.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
            New Transaction
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-sm text-gray-500">Today's Transactions</p>
            <p class="text-2xl font-bold text-gray-800">{{ $todayCount }}</p>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-sm text-gray-500">Today's Revenue</p>
            <p class="text-2xl font-bold text-green-600">Rp {{ number_format($todayTotal, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('kasir.transactions.create') }}" class="block p-4 border-2 border-dashed border-gray-300 rounded-lg text-center hover:border-indigo-500 hover:bg-indigo-50">
                <span class="text-4xl">+</span>
                <p class="mt-2 font-medium">New Transaction</p>
            </a>
            <a href="{{ route('kasir.transactions.index') }}" class="block p-4 border-2 border-dashed border-gray-300 rounded-lg text-center hover:border-indigo-500 hover:bg-indigo-50">
                <span class="text-4xl">📋</span>
                <p class="mt-2 font-medium">View History</p>
            </a>
        </div>
    </div>
</div>
@endsection