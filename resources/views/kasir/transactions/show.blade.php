@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Transaction Details</h1>
        <a href="{{ route('kasir.transactions.index') }}" class="text-blue-600 hover:text-blue-900">Back</a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">Invoice Number</p>
                <p class="font-medium">{{ $transaction->invoice_number }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Date</p>
                <p class="font-medium">{{ $transaction->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Customer</p>
                <p class="font-medium">{{ $transaction->customer_name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Status</p>
                <span class="px-2 py-1 text-xs rounded-full {{ $transaction->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ $transaction->status }}
                </span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Service</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($transaction->details as $detail)
                <tr>
                    <td class="px-6 py-4">{{ $detail->service_name }}</td>
                    <td class="px-6 py-4">{{ $detail->service_type }}</td>
                    <td class="px-6 py-4">{{ $detail->quantity }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($detail->unit_price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="px-6 py-4 text-right font-medium">Total</td>
                    <td class="px-6 py-4 font-bold">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">Payment Method</p>
                <p class="font-medium">{{ $transaction->payment_method }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Paid Amount</p>
                <p class="font-medium">Rp {{ number_format($transaction->paid_amount, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Change</p>
                <p class="font-medium">Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <a href="{{ route('kasir.transactions.receipt', $transaction->id) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 inline-block">Print Receipt</a>
</div>
@endsection