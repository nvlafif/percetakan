@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-lg shadow p-8 max-w-2xl mx-auto">
        <div class="text-center border-b pb-4 mb-4">
            <h1 class="text-2xl font-bold">Percetakan</h1>
            <p class="text-sm text-gray-500">Jl. Contoh No. 123, Jakarta</p>
        </div>

        <div class="mb-4">
            <p><strong>Invoice:</strong> {{ $transaction->invoice_number }}</p>
            <p><strong>Tanggal:</strong> {{ $transaction->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Pelanggan:</strong> {{ $transaction->customer_name }}</p>
        </div>

        <table class="w-full mb-4">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-2">Service</th>
                    <th class="text-right py-2">Qty</th>
                    <th class="text-right py-2">Price</th>
                    <th class="text-right py-2">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaction->details as $detail)
                <tr class="border-b">
                    <td class="py-2">{{ $detail->service_name }}</td>
                    <td class="text-right py-2">{{ $detail->quantity }}</td>
                    <td class="text-right py-2">Rp {{ number_format($detail->unit_price, 0, ',', '.') }}</td>
                    <td class="text-right py-2">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="border-t pt-4">
            <div class="flex justify-between">
                <span>Total</span>
                <span class="font-bold">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span>Pembayaran</span>
                <span>{{ $transaction->payment_method }}</span>
            </div>
            <div class="flex justify-between">
                <span>Dibayar</span>
                <span>Rp {{ number_format($transaction->paid_amount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span>Kembalian</span>
                <span>Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="text-center mt-8">
            <p class="text-sm text-gray-500">Terima kasih atas kunjungan Anda!</p>
        </div>
    </div>

    <div class="text-center">
        <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Print</button>
        <a href="{{ route('kasir.transactions.index') }}" class="ml-2 text-gray-600 hover:text-gray-900">Back</a>
    </div>
</div>
@endsection