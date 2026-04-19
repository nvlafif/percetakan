<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('kasir.transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('kasir.transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.service_name' => 'required|string|max:255',
            'items.*.service_type' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,transfer',
            'paid_amount' => 'required|numeric|min:0',
        ]);

        $items = $request->items;
        $subtotal = 0;

        foreach ($items as $item) {
            $item['subtotal'] = $item['quantity'] * $item['unit_price'];
            $subtotal += $item['subtotal'];
        }

        $total = $subtotal;
        $paidAmount = $request->paid_amount;
        $changeAmount = $paidAmount - $total;

        if ($changeAmount < 0) {
            return back()->with('error', 'Insufficient payment amount')->withInput();
        }

        $transaction = Transaction::create([
            'invoice_number' => Transaction::generateInvoiceNumber(),
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'payment_method' => $request->payment_method,
            'status' => 'completed',
            'subtotal' => $subtotal,
            'discount' => 0,
            'total' => $total,
            'paid_amount' => $paidAmount,
            'change_amount' => $changeAmount,
            'notes' => $request->notes,
        ]);

        foreach ($items as $item) {
            $subtotal = $item['quantity'] * $item['unit_price'];
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'service_name' => $item['service_name'],
                'service_type' => $item['service_type'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'subtotal' => $subtotal,
            ]);
        }

        return redirect()->route('kasir.transactions.receipt', $transaction->id)
            ->with('success', 'Transaction completed successfully');
    }

    public function receipt(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        return view('kasir.transactions.receipt', compact('transaction'));
    }

    public function show(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $transaction->load('details');

        return view('kasir.transactions.show', compact('transaction'));
    }

    public function dashboard()
    {
        $todayTransactions = Transaction::where('user_id', Auth::id())
            ->whereDate('created_at', today())
            ->get();

        $todayTotal = $todayTransactions->sum('total');
        $todayCount = $todayTransactions->count();

        return view('kasir.dashboard', compact('todayTotal', 'todayCount'));
    }
}
