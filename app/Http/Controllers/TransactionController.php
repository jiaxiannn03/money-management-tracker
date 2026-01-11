<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{   
    public function index(){ //main page , show all transaction & balance
        
        $total_income= Transaction::where('trans_type','income')->sum('amount_myr');
        $total_expense= Transaction::where('trans_type','expense')->sum('amount_myr');
        $balance= $total_income - $total_expense;
        $incomes=Transaction::where('trans_type','income')->orderBy('trans_date','desc')->get();
        $expenses=Transaction::where('trans_type','expense')->orderBy('trans_date','desc')->get();
        return view('homepage',compact('balance','incomes','expenses'));
    }

    public function store(Request $req){
        $req->validate([
            'category'=>'required',
            'trans_type'=>'required|in:income,expense',
            'amount'=>'required|numeric',
            'currency'=>'required|in:myr,usd,sgd,cny',
            'trans_date'=>'required|date'

        ]);

        $rates = [
            'MYR'=>1,
            'USD'=>4.09,
            'SGD'=>3.18,
            'CNY'=>0.58,
        ];

        $currency = strtoupper($req->currency);
        $amountMYR = $req->amount * $rates[$currency];
        Transaction::create([
            'trans_type' => $req->trans_type,
            'category' => $req->category,
            'amount' => $req->amount,
            'currency' => $currency,
            // 'exchange_rate' => $rates[$req->currency],
            'amount_myr' => $amountMYR,
            'trans_date' => $req->trans_date
        ]);
        return redirect('/')->with('success','Successfully added transaction.');
    }

    public function showAddTransactionForm(){
        return view('addTransactionForm');
    }

    public function showEditTransactionForm($id){
        $transaction=Transaction::find($id);
        return view('editTransactionForm',compact('transaction'));


    }

    public function update(Request $req,$id){
        $transaction=Transaction::find($id);
        $req->validate([
            'category'=>'required',
            'trans_type'=>'required|in:income,expense',
            'amount'=>'required|numeric',
            'currency'=>'required|in:myr,usd,sgd,cny',
            'trans_date'=>'required|date'

        ]);

        $rates = [
            'MYR'=>1,
            'USD'=>4.09,
            'SGD'=>3.18,
            'CNY'=>0.58,
        ];

        $currency = strtoupper($req->currency);
        $amountMYR = $req->amount * $rates[$currency];
        $transaction->update([
            'trans_type' => $req->trans_type,
            'category' => $req->category,
            'amount' => $req->amount,
            'currency' => $currency,
            // 'exchange_rate' => $rates[$req->currency],
            'amount_myr' => $amountMYR,
            'trans_date' => $req->trans_date
        ]);
        return redirect('/')->with('success','Successfully update transaction.');
    }

    public function destroy($id){
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return redirect('/')->with('success','Successfully deleted transaction.');
    }

}
