<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->cannot('voir transactions')) {
            return redirect()->back();
        }

        $transactions = Transaction::all();
        return view("transactions.index")->with("transactions", $transactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->cannot('editer transactions')) {
            return redirect()->back();
        }

        $transactions = Transaction::all();
        $accounts = Account::all();

        return view("transactions.create")->with("transactions", $transactions)->with("accounts", $accounts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if (Auth::user()->cannot('editer transactions')) {
            return redirect()->back();
        }

        request()->validate([
            'account_id' => 'required',
            'type' => ['required'],
            'description' => ['required', 'string'],
            'montant' => ['required', 'numeric'],
        ]);


        if($request->hasFile('fichier')){

            request()->validate([
                'fichier' => 'mimes:pdf, max:1024'
            ]);

            $filename = $request->fichier->getClientOriginalName();
            $request->fichier->storeAs('fiches_de_paie',$filename,'public');
        }

        $account = Account::findOrFail($request->account_id);
        $transaction = new Transaction;

        if ($request->type == "depot") {

            $account->solde += abs($request->montant);
            $transaction->depot = abs($request->montant);

        }elseif($request->type == "retrait"){

            $account->solde -= abs($request->montant);
            $transaction->retrait = abs($request->montant);
        }

        $account->save();
        
        // if($request->type = "retrait"){
        //     $transaction->retrait = $request->montant;
        // };

        $transaction->description = $request->description;
        $transaction->balance = $account->solde;
        $transaction->account_id = $account->id;
        $transaction->save();

        return redirect()->route("transactions.index")->with("message", "transaction ajoutée");

        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->cannot('editer transactions')) {
            return redirect()->back();
        }

        return redirect()->back();
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return redirect()->back();
    }
}