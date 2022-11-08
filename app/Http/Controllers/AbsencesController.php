<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Absence;
use App\Notifications\AbsenceNotification;
Use App\Models\User;

class AbsencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // here we 
        $user = Auth::user();
        if (!$user->hasPermissionTo('editer absences')) {
            $absences = $user->absences()->get();
            return view("absences.index")->with("absences", $absences);
        }
        else{
            $absences = Absence::all();
            return view("absences.index")->with("absences", $absences);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("absences.create");
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

        request()->validate([
            'motif' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string'],
            'du_heure' => ['required', 'before:au_heure'],
            'au_heure' => ['required', 'after:du_heure'],
        ]);

        $absence = new Absence;
        $absence->motif = request("motif");
        $absence->details = request("details");
        $absence->du_heure = request("du_heure");
        $absence->au_heure = request("au_heure");
        $absence->user_id = $user->id;

        $absence->save();

        return redirect()->route("absences.index")->with("message", "Absence ajouté !");

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
        //
        $absence = Absence::findOrFail($id);

        return view("absences.edit")->with("absence", $absence);
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
            'motif' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string'],
            'du_heure' => ['required', 'string', 'before:au_heure'],
            'au_heure' => ['required', 'string', 'after:du_heure'],
        ]);

        $absence = Absence::findOrFail($id);
        
        $absence->motif = request("motif");
        $absence->details = request("details");
        $absence->du_heure = request("du_heure");
        $absence->au_heure = request("au_heure");
        $absence->status = request("status");
        $absence->raison = request("raison");
        
        $absence->user_id = request("user_id");

        $absence->save();

        $user = User::findOrFail(request('user_id'));
         // We dont want the user to notify themself when they make a change to their request
        
        if (!(auth()->user()->id == $user->id)) {
            $user->notify(new AbsenceNotification());
        }

        return redirect()->route("absences.index")->with("message", "Absence modifée !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user->hasPermissionTo('editer absences')) {
            return redirect()->back();
        }
        $absence = Absence::findOrFail($id);
        $absence->delete();

        return redirect()->route("absences.index")->with("message", "absence suprimé !");

    }

    public function changer_absence_status(Request $request){

        $user = Auth::user();
        if (!$user->hasPermissionTo('editer absences')) {
            return redirect()->back();
        }

        $id = request("absence_id");

        $absence = Absence::findOrFail($id);

        $absence->status = request("status");
        $absence->save();

        return redirect()->route("absences.index")->with("message", "status de l'absence modifié !");
    }

}
