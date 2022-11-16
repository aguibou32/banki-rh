<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\FicheDePaie;
use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;

class FichesDePaieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        if (!$user->hasPermissionTo('editer fiches de paie')) {
            $fiches = $user->fiches_de_paie()->latest()->get();
            return view("fiches_de_paie.index")->with("fiches", $fiches);
        }
        else{
            $fiches = FicheDePaie::latest()->get();
        return view("fiches_de_paie.index")->with("fiches", $fiches);
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if (!$user->hasPermissionTo('editer fiches de paie')) {
           return redirect()->back();
        }else{
            $users = User::whereNotIn('name', ['Super'])->get();
            $accounts = Account::all();
            return view("fiches_de_paie.create")->with("users", $users)->with("accounts", $accounts);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user->hasPermissionTo('editer fiches de paie')) {
           return redirect()->back();
        }

        request()->validate([
            'user_id' => ['required'],
            'title' => ['required', 'string', 'max:255'],
            'account_id' => ['required', 'string'],
            'montant' => ['required', 'string'],
            'description' => ['required', 'string'],
            'date' => ['required'],
            'fichier' => ['required','mimes:pdf','max:1024']
        ]);


        $user = User::findOrFail($request->user_id);

        $filename = $user->name."_".$user->surname."_".$user->matricule."_".$request->fichier->getClientOriginalName();
        $request->fichier->storeAs('fiches_de_paie',$filename,'public');

        $fiche = new FicheDePaie;
        $fiche->title = $request->title;
        $fiche->montant = $request->montant;
        $fiche->description = $request->description;
        $fiche->date = $request->date;
        $fiche->fichier = $filename;
        $fiche->user_id = $request->user_id;

        $fiche->save();

        $account = Account::findOrFail($request->account_id);
        $account->solde -= abs($request->montant);
        $account->save();

        $transaction = new Transaction;
        $transaction->description = $request->description;
        $transaction->retrait = abs($request->montant);
        $transaction->balance = $account->solde;
        $transaction->account_id = $account->id;
        $transaction->save();

        return redirect()->route("fiches_de_paie.index")->with("message", "Fiche de paie ajouté !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        return back();

        // $user = Auth::user();
        
        // if (!$user->hasPermissionTo('editer fiches de paie')) {
        //    return redirect()->back();
        // }

        // $fiche = FicheDePaie::findOrFail($id);
        // $users = User::whereNotIn('name', ['Super'])->get();
        // $accounts = Account::all();

        // return view("fiches_de_paie.edit")->with("fiche", $fiche)->with("users", $users)->with("accounts", $accounts);

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
        return $request->all();

        $user = Auth::user();
        
        if (!$user->hasPermissionTo('editer fiches de paie')) {
           return redirect()->back();
        }

        request()->validate([
            'user_id' => ['required'],
            'account_id' => ['required'],
            'title' => ['required', 'string', 'max:255'],
            'montant' => ['required', 'string'],
            'description' => ['required', 'string'],
            'date' => ['required'],
            // 'fichier' => ['required','mimes:pdf','max:1024']
        ]);

        $user = User::findOrFail($request->user_id);

        if($request->hasFile('fichie')){

            request()->validate([
                'fichier' => 'mimes:pdf, max:1024'
            ]);

            $filename = $user->name."_".$user->surname."_".$user->matricule."_".$request->fichier->getClientOriginalName();
            $request->fichier->storeAs('fiches_de_paie',$filename,'public');
            
        }


        $fiche = FicheDePaie::findOrFail($id);
        $fiche->title = $request->title;
        $fiche->montant = $request->montant;
        $fiche->description = $request->description;
        $fiche->date = $request->date;
        $fiche->fichier = $filename;
        $fiche->user_id = $request->user_id;

        $fiche->save();

        $account = Account::findOrFail($request->account_id);
        $account->solde -= abs($request->montant);
        $account->save();

        $transaction = new Transaction;
        $transaction->description = $request->description;
        $transaction->retrait = abs($request->montant);
        $transaction->balance = $account->solde;
        $transaction->account_id = $account->id;
        $transaction->save();

        return redirect()->route("fiches_de_paie.index")->with("message", "Fiche de paie modifié !");
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

        $fiche = FicheDePaie::findOrFail($id);

        return $fiche;
        

    }

    public function telecharger_fichier_paie($file_name) {
        
        $file_path = public_path('storage/fiches_de_paie/'.$file_name);

        return response()->download($file_path);
    }

    public function employee_confirmation($fiche_id){
        
        $fiche = FicheDePaie::findOrFail($fiche_id);

        $fiche->employee_confirmation = "confirmé";
        $fiche->save();

        return redirect()->back();
    }
}
