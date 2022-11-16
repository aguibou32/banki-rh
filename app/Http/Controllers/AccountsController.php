<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Account;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->cannot('voir comptes')) {
            return redirect()->back();
        }

        $accounts = Account::all();
        return view("accounts.index")->with("accounts", $accounts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->cannot('editer comptes')) {
            return redirect()->back();
        }

        return view("accounts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->cannot('editer comptes')) {
            return redirect()->back();
        }

        request()->validate([
            'numero' => ['required', 'numeric', 'unique:accounts'],
            'solde' => ['required', 'numeric'],
        ]);

        $account = new Account;
        $account->numero = $request->numero;
        $account->solde = $request->solde;

        $account->save();
        return redirect()->route("accounts.index")->with("message", "un compte ajouté !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if (Auth::user()->cannot('editer comptes')) {
            return redirect()->back();
        }
        $account = Account::findOrFail($id);
        return view("accounts.edit")->with("account", $account);
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
        if (Auth::user()->cannot('editer comptes')) {
            return redirect()->back();
        }

        $account = Account::findOrFail($request->account_id);

        request()->validate([
            'numero' => ['required', 'numeric' ,Rule::unique('accounts')->ignore($account->id)],
            'solde' => ['required', 'numeric'],
        ]);

        $account = Account::findOrFail($id);

        $account->numero = $request->numero;
        $account->solde = $request->solde;

        $account->save();
        return redirect()->route("accounts.index")->with("message", "compte modifié !");
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
        $account = Account::findOrFail($id);
        $account->delete();

        return redirect()->back()->with("message", "Compte a été supprimé !");
    }
}
