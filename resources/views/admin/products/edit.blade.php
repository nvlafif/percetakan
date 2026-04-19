@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Product</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" value="{{ $product->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">SKU</label>
                    <input type="text" name="sku" value="{{ $product->sku }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Category</label>
                    <input type="text" name="category" value="{{ $product->category }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" name="stock" value="{{ $product->stock }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Min Stock</label>
                    <input type="number" name="min_stock" value="{{ $product->min_stock }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Unit Cost</label>
                    <input type="number" name="unit_cost" value="{{ $product->unit_cost }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Unit Price</label>
                    <input type="number" name="unit_price" value="{{ $product->unit_price }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2" required>
                        <option value="active" {{ $product->status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $product->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Update</button>
                <a href="{{ route('admin.products.index') }}" class="ml-2 text-gray-600 hover:text-gray-900">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection