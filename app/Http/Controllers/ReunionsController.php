<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Reunion;
use App\Models\User;

use App\Notifications\ReunionNotification;

class ReunionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $reunions = Reunion::latest()->get();
        return view("reunions.index")->with("user", $user)->with("reunions", $reunions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if (!$user->hasPermissionTo('editer reunions')) {
            return redirect()->back();
        }

        return view("reunions.create");
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
        if (!$user->hasPermissionTo('editer reunions')) {
            return redirect()->back();
        }

        request()->validate([
            'titre' => ['required', 'string', 'max:255'],
            'contenu' => ['required', 'string'],
        ]);

        $reunion = new Reunion;

        if($request->hasFile('fichier')){
            request()->validate([
                'fichier' => 'max:1024'
            ]);
            
            $filename = $request->fichier->getClientOriginalName();
            $request->fichier->storeAs('reunions_fichiers',$filename,'public');
            // $reunion->update(['fichier'=>$filename]);
            $reunion->fichier = $filename;
        }

        $reunion->titre = request("titre");
        $reunion->contenu = request("contenu");

        $users = User::all();
        $reunion->save();

        foreach ($users as $user) {
            $user->notify(new ReunionNotification());
        }
        

        return redirect()->route("reunions.index")->with("message", "Reunion a été ajouté");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reunion = Reunion::findOrFail($id);
        return view("reunions.show")->with("reunion", $reunion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reunion = Reunion::findOrFail($id);
        $users = User::whereNotIn('name', ['Super'])->get();
        
        return view("reunions.edit")->with("reunion", $reunion)->with("users", $users);
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
        if (!$user->hasPermissionTo('editer reunions')) {
            return redirect()->back();
        }

        request()->validate([
            'titre' => ['required', 'string', 'max:255'],
            'contenu' => ['required', 'string'],
        ]);

        $reunion = Reunion::findOrFail($id);

        if($request->hasFile('fichier')){
            request()->validate([
                'fichier' => 'max:1024'
            ]);
            
            $filename = $request->fichier->getClientOriginalName();
            $request->fichier->storeAs('reunions_fichiers',$filename,'public');
            // $reunion->update(['fichier'=>$filename]);
            $reunion->fichier = $filename;
        }

        $reunion->titre = request("titre");
        $reunion->contenu = request("contenu");

        $reunion->save();
        return redirect()->route("reunions.index")->with("message", "Reunion modifié");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reunion = Reunion::findOrFail($id);
        $reunion->delete();

        return redirect()->route("reunions.index")->with("message", "Rapport de réunion supprimé !");
    }

    public function telecharger_fichier_reunion($file_name) {
        
        $file_path = public_path('storage/reunions_fichiers/'.$file_name);
        return response()->download($file_path);
    }

    public function attach_reunion_user(Request $request){

        $public = $request->public;

        $reunion = Reunion::findOrFail(request("reunion_id"));

        if ($public == "on") {

            $users = User::whereNotIn('name', ['Super'])->get();

            foreach ($users as $user) {
                if (!($user->reunions($reunion)->exists())) {
                    $user->reunions()->attach($reunion);
                }
            }
            return redirect()->back()->with("message", "Rapport est rendu publique");
        }
        else{
            $user = User::findOrFail(request("user_id"));
           
            if (!($user->reunions($reunion)->exists())) {
                $user->reunions()->attach($reunion);
                return redirect()->back()->with("message", "Accès à ce rapport donné à l'utilisateur");
            }
        }
    }


    public function detach_reunion_user($user_id, $reunion_id){
        $reunion = Reunion::findOrFail($reunion_id);
        $user = User::findOrFail($user_id);

        $user->reunions()->detach($reunion);
        return redirect()->back()->with("message", "Accès à ce rapport révoqué à l'utilisateur");


    }

}
