@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Finance Report</h1>
        <a href="{{ route('admin.finance.index') }}" class="text-blue-600 hover:text-blue-900">Back to Finance</a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Monthly Income</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Month</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Year</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Income</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($monthlyIncomes as $income)
                <tr>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::create()->month($income->month)->format('F') }}</td>
                    <td class="px-6 py-4">{{ $income->year }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($income->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Monthly Expenses</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Month</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Year</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Expense</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($monthlyExpenses as $expense)
                <tr>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::create()->month($expense->month)->format('F') }}</td>
                    <td class="px-6 py-4">{{ $expense->year }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($expense->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection