<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Activite;

class ActivitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activités_à_faire = Activite::where("status", "a faire")->get();
        $activités_en_progres = Activite::where("status", "en progres")->get();
        $activités_fini = Activite::where("status", "fini")->get();
        return view("activites.index")->with("activités_à_faire", $activités_à_faire)
                                    ->with("activités_en_progres", $activités_en_progres)
                                    ->with("activités_fini", $activités_fini);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'activité' => ['required', 'string'],
            'début' => ['required'],
            'fin' => ['required'],
            'difficulté' => ['required', 'string'],
        ]);

        $activité = new Activite;
        $user = Auth::user();

        $activité->activité = request("activité");
        $activité->début = request("début");
        $activité->fin = request("fin");
        $activité->difficulté = request("difficulté");
        $activité->user_id = $user->id;
        
        $activité->save();
        return redirect()->route("activites.index")->with("message", "activité ajouté !");
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
        return 1;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activité = Activite::findOrFail($id);
        return view("activites.edit")->with("activité", $activité);
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
        request()->validate([
            'activité' => ['required', 'string'],
            'début' => ['required', 'before:fin'],
            'fin' => ['required', 'after:début'],
            'description' => ['required', 'string'],
            'difficulté' => ['required', 'string'],
            'status' => ['required', 'string']
        ]);

        $activité = Activité::findOrFail($id);
        $activité->activité = request("activité");
        $activité->début = request("début");
        $activité->fin = request("fin");
        $activité->description = request("description");
        $activité->difficulté = request("difficulté");
        $activité->status = request("status");
        $activité->présence_id = request("présence_id");
        $activité->validation = "validé";

        $activité->save();
        return redirect()->route("présences.index")->with("message", "activité modifié !");
    }

    
    public function activité_a_faire($id){
        $activité = Activite::findOrFail($id);
        $activité->status = "à faire";

        $activité->save();
        return redirect()->route("activites.index")->with("message", "activité ajouté au column à faire ");
    }

    public function activité_en_progres($id){
        $activité = Activite::findOrFail($id);
        $activité->status = "en progrès";

        $activité->save();
        return redirect()->route("activites.index")->with("message", "activité ajouté au column En Progrès ");
    }

    public function activité_fini($id){
        $activité = Activite::findOrFail($id);
        $activité->status = "fini";

        $activité->save();
        return redirect()->route("activites.index")->with("message", "activité ajouté au column Fini ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $activité = Activite::findOrFail($id);
        $activité->delete();
        return redirect()->back()->with("message", "activité a été suprimé");
    }
}
