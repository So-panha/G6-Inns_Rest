<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // You can pass data to the view if needed
        $this->params = $request->only('searchDate');
        $transactions = Transaction::list($this->params);

        // payment of the current transaction (today)
        $date = date('Y-m-d');
        $transactionsToday = Transaction::where('date_paid', $date)->get();
        return view('payment.transaction', compact('transactions', 'transactionsToday'));
    }
}
