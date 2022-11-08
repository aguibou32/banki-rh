<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Depense;

class DepensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = Auth::user();
        if (!$user->hasPermissionTo('voir depenses')) {
            return redirect()->back();
        }

        $depenses = Depense::all();
        return view("depenses.index")->with("depenses", $depenses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if (!$user->hasPermissionTo('editer depenses')) {
            return redirect()->back();
        }
        return view("depenses.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user();
        if (!$user->hasPermissionTo('editer depenses')) {
            return redirect()->back();
        }
        request()->validate([
            'intitulé' => ['required', 'string', 'max:255'],
            'montant' => ['required', 'numeric'],
            'description' => ['required', 'string', 'max:255']
        ]);

        $depense = new Depense;

        if($request->hasFile('facture')){
            request()->validate([
                'facture' => 'max:1024'
            ]);
            
            $filename = $request->facture->getClientOriginalName();
            $request->facture->storeAs('dépenses',$filename,'public');
            $depense->facture = $filename;
        }

        $depense->intitulé = request("intitulé");
        $depense->montant = request("montant");
        $depense->description = request("description");

        $depense->save();
        return redirect()->route("depenses.index")->with("message", "dépense a été ajouté");
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
        //
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
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $depense = Depense::findOrFail($id);
        $depense->delete();
        return redirect()->back()->with("message", "dépense supprimée !");
    }

    public function telecharger_fichier_depense($file_name) {
        $file_path = public_path('storage/dépenses/'.$file_name);
        return response()->download($file_path);
    }


}
