<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\User;
use App\Models\Notification;

use App\Notifications\AnnonceNotification;

class AnnoncesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $annonces = Annonce::latest()->paginate(20);
        return view("annonces.index")->with("annonces", $annonces);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if (!$user->hasPermissionTo('editer annonces')) {
            return redirect()->back();
        }

        return view("annonces.create");
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
        if (!$user->hasPermissionTo('editer annonces')) {
            return redirect()->back();
        }

        request()->validate([
            'titre' => ['required', 'string', 'max:255'],
            'contenu' => ['required', 'string'],
        ]);

        $annonce = new Annonce;

        if($request->hasFile('fichier')){
            request()->validate([
                'fichier' => 'max:1024'
            ]);
            
            $filename = $request->fichier->getClientOriginalName();
            $request->fichier->storeAs('annonces_fichiers',$filename,'public');
            // $annonce->update(['fichier'=>$filename]);
            $annonce->fichier = $filename;
        }

        $annonce->titre = request("titre");
        $annonce->contenu = request("contenu");

        $users = User::all();
        $annonce->save();

        foreach ($users as $user) {
            $user->notify(new AnnonceNotification());
        }

        return redirect()->route("annonces.index")->with("message", "Annonce a été ajouté");
        
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
        $annonce = Annonce::findOrFail($id);
        return view("annonces.edit")->with("annonce", $annonce);
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
        $user = Auth::user();
        if (!$user->hasPermissionTo('editer annonces')) {
            return redirect()->back();
        }

        request()->validate([
            'titre' => ['required', 'string', 'max:255'],
            'contenu' => ['required', 'string'],
        ]);

        $annonce = Annonce::findOrFail($id);

        if($request->hasFile('fichier')){
            request()->validate([
                'fichier' => 'max:1024'
            ]);
            
            $filename = $request->fichier->getClientOriginalName();
            $request->fichier->storeAs('annonces_fichiers',$filename,'public');
            // $annonce->update(['fichier'=>$filename]);
            $annonce->fichier = $filename;
        }

        $annonce->titre = request("titre");
        $annonce->contenu = request("contenu");

        $annonce->save();
        return redirect()->route("annonces.index")->with("message", "Annonce modifié");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $annonce = Annonce::findOrFail($id);
        $annonce->delete();

        return redirect()->route("annonces.index")->with("message", "Annonce supprimé !");
    }

    public function telecharger_fichier_annonce($file_name) {
        
        $file_path = public_path('storage/annonces_fichiers/'.$file_name);
        return response()->download($file_path);
    }

}
