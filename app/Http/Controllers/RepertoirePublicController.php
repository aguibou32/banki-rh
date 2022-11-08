<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RepertoirePublic;
use Illuminate\Support\Facades\Auth;
use App\Notifications\RepertoirePublicNotification;
use App\Models\User;

class RepertoirePublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     **/
    public function index()
    {
        $repertoires = RepertoirePublic::latest()->get();
        return view("repertoire_public.index")->with("repertoires", $repertoires);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if (!$user->hasPermissionTo('editer repertoire public')) {
            return redirect()->back();
        }   
        return view("repertoire_public.create");
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
        if (!$user->hasPermissionTo('editer repertoire public')) {
            return redirect()->back();
        } 
        request()->validate([
            'titre' => ['required', 'string', 'max:255'],
            'fichier' => ['required']
        ]);

        $repertoire = new RepertoirePublic;

        $filename = $request->fichier->getClientOriginalName();
        $request->fichier->storeAs('repertoire_public',$filename,'public');
        
        $repertoire->titre = request("titre");
        $repertoire->fichier = $filename;

        $repertoire->save();

        $users = User::all();

        foreach ($users as $user) {
            $user->notify(new RepertoirePublicNotification());
        }

        // foreach ($users as $user) {
        //     $user->notify(new AnnonceNotification());
        // }


        return redirect()->route("repertoire_public.index")->with("message", "Fichier ajouté avec succès");
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
        $user = Auth::user();
        if (!$user->hasPermissionTo('editer repertoire public')) {
            return redirect()->back();
        } 

        $repertoire = RepertoirePublic::findOrFail($id);
        return view("repertoire_public.edit")->with("repertoire", $repertoire);
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
        if (!$user->hasPermissionTo('editer repertoire public')) {
            return redirect()->back();
        } 

        request()->validate([
            'titre' => ['required', 'string', 'max:255']
        ]);

        $repertoire = RepertoirePublic::findOrFail($id);

        if($request->hasFile('fichier')){
            request()->validate([
                'fichier' => 'max:1024'
            ]);
            
            $filename = $request->fichier->getClientOriginalName();
            $request->fichier->storeAs('repertoire_public',$filename,'public');
            $repertoire->titre = request("titre");
            $repertoire->fichier = $filename;
            $repertoire->update();
        }

        $repertoire->titre = request("titre");

        $repertoire->save();
        return redirect()->route("repertoire_public.index")->with("message", "Répertoire mis à jour");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $repertoire = RepertoirePublic::findOrFail($id);

        $repertoire->delete();
        return redirect()->back()->with("message", "Répertoire effacé");
        //
    }


    public function telecharger_fichier_public($file_name) {
        $file_path = public_path('storage/repertoire_public/'.$file_name);
        return response()->download($file_path);
    }
}
