<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Presence;
use App\Models\Activité;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PresencesImport;

use Carbon\Carbon;

class PresencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presences = Presence::orderBy('emp_no', 'asc')-> get();
        return view("presences.index")->with("presences", $presences);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("presences.create");
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
            'date' => ['unique:présences'],
            'heure_arrivé' => ['required', 'before:heure_départ'],
            'heure_départ' => ['required', 'after:heure_arrivé'],
        ]);

        $présence = new Presence;

        $date = Carbon::today()->toDateString();
        $présence->date = $date;
        $présence->heure_arrivé = request("heure_arrivé");
        $présence->heure_départ = request("heure_départ");
        $présence->validation = "en attente";
        $présence->user_id = Auth::user()->id;

        $présence->save();
        return redirect()->route("presences.index")->with("message", "Votre présence a été ajouté");

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

    public function import(Request $request){
        request()->validate([
            'presences_file' => ['required', 'mimes:xlsx']
        ]);
        $file = $request->file('presences_file')->store("presences_import");

        // Excel::import(new PresencesImport, request()->file('presences_file'));
        Excel::import(new PresencesImport, $file);
        return redirect()->route("presences.index")->with("message", "Données importés");
    }
}
