@extends('layouts.kasir')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">New Transaction</h1>

    <form id="transactionForm" method="POST" action="{{ route('kasir.transactions.store') }}" class="space-y-6">
        @csrf
        
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Customer Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Customer Name</label>
                    <input type="text" name="customer_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Services</h2>
                <button type="button" onclick="addItem()" class="text-indigo-600 hover:text-indigo-800">+ Add Item</button>
            </div>
            
            <div id="itemsContainer" class="space-y-4">
                <div class="item-row grid grid-cols-1 md:grid-cols-5 gap-4 items-center">
                    <input type="text" name="items[0][service_name]" placeholder="Service Name" required class="rounded-md border-gray-300">
                    <select name="items[0][service_type]" required class="rounded-md border-gray-300">
                        <option value="print">Print</option>
                        <option value="photocopy">Photocopy</option>
                        <option value="design">Design</option>
                        <option value="other">Other</option>
                    </select>
                    <input type="number" name="items[0][quantity]" placeholder="Qty" value="1" min="1" required class="rounded-md border-gray-300" onchange="calculateSubtotal(this)">
                    <input type="number" name="items[0][unit_price]" placeholder="Price" value="0" min="0" required class="rounded-md border-gray-300" onchange="calculateSubtotal(this)">
                    <span class="subtotal font-medium">Rp 0</span>
                </div>
            </div>
            
            <div class="mt-4 pt-4 border-t">
                <div class="flex justify-between text-lg">
                    <span>Total:</span>
                    <span id="grandTotal" class="font-bold text-xl">Rp 0</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Payment</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                    <select name="payment_method" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Paid Amount</label>
                    <input type="number" name="paid_amount" id="paidAmount" required min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" onchange="calculateChange()">
                </div>
            </div>
            <div class="mt-4">
                <div class="flex justify-between text-lg">
                    <span>Change:</span>
                    <span id="changeAmount" class="font-bold">Rp 0</span>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('kasir.dashboard') }}" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Process Payment</button>
        </div>
    </form>
</div>

<script>
let itemCount = 1;

function addItem() {
    const container = document.getElementById('itemsContainer');
    const html = `
        <div class="item-row grid grid-cols-1 md:grid-cols-5 gap-4 items-center">
            <input type="text" name="items[${itemCount}][service_name]" placeholder="Service Name" required class="rounded-md border-gray-300">
            <select name="items[${itemCount}][service_type]" required class="rounded-md border-gray-300">
                <option value="print">Print</option>
                <option value="photocopy">Photocopy</option>
                <option value="design">Design</option>
                <option value="other">Other</option>
            </select>
            <input type="number" name="items[${itemCount}][quantity]" placeholder="Qty" value="1" min="1" required class="rounded-md border-gray-300" onchange="calculateSubtotal(this)">
            <input type="number" name="items[${itemCount}][unit_price]" placeholder="Price" value="0" min="0" required class="rounded-md border-gray-300" onchange="calculateSubtotal(this)">
            <span class="subtotal font-medium">Rp 0</span>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    itemCount++;
}

function calculateSubtotal(element) {
    const row = element.closest('.item-row');
    const qty = parseFloat(row.querySelector('[name*="quantity"]').value) || 0;
    const price = parseFloat(row.querySelector('[name*="unit_price"]').value) || 0;
    row.querySelector('.subtotal').textContent = 'Rp ' + (qty * price).toLocaleString('id-ID');
    calculateTotal();
}

function calculateTotal() {
    let total = 0;
    document.querySelectorAll('.item-row').forEach(row => {
        const qty = parseFloat(row.querySelector('[name*="quantity"]').value) || 0;
        const price = parseFloat(row.querySelector('[name*="unit_price"]').value) || 0;
        total += qty * price;
    });
    document.getElementById('grandTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');
}

function calculateChange() {
    const paid = parseFloat(document.getElementById('paidAmount').value) || 0;
    let total = 0;
    document.querySelectorAll('.item-row').forEach(row => {
        const qty = parseFloat(row.querySelector('[name*="quantity"]').value) || 0;
        const price = parseFloat(row.querySelector('[name*="unit_price"]').value) || 0;
        total += qty * price;
    });
    const change = paid - total;
    document.getElementById('changeAmount').textContent = 'Rp ' + change.toLocaleString('id-ID');
}
</script>
@endsection