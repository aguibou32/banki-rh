<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Stockage;

class StockagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $stockages = $user->stockages;
        return view("stockages.index")->with("stockages", $stockages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("stockages.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate([
            'titre' => ['required', 'string', 'max:255'],
            'fichier' => ['required', 'file'],
        ]);

        $user = Auth::user();
        $stockage = new Stockage;

        $filename = $request->fichier->getClientOriginalName();
        $request->fichier->storeAs('stockages',$filename,'public');
        
        $stockage->titre = request("titre");
        $stockage->fichier = $filename;
        $stockage->user_id = $user->id;

        $stockage->save();
        return redirect()->route("stockage.index")->with("message", "Fichier ajouter avec succès");
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
    }

    public function telecharger_fichier_stockage($file_name) {
        $file_path = public_path('storage/stockages/'.$file_name);
        return response()->download($file_path);
    }
}
