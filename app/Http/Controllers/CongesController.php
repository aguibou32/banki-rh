<?php

namespace App\Http\Controllers;

use App\Notifications\CongeNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Conge;
use App\Models\User;

class CongesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user->hasPermissionTo('editer conges')) {
            $conges = $user->conges()->get();
            return view("conges.index")->with("conges", $conges);
        }
        else{
            $conges = Conge::all();
            return view("conges.index")->with("conges", $conges);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("conges.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // return request()->all();

        $user = Auth::user();
        $id = $user->id;

        request()->validate([
            'motif' => ['required', 'string'],
            'user_id' => ['required'],
            'details' => ['required', 'string'],
            'du_date' => ['required', 'string', 'after:yesterday', 'before:au_date'],
            'au_date' => ['required', 'string', 'after:du_date'],
        ]);


        $congé = new Conge;
        $congé->motif = request("motif");
        $congé->details = request("details");
        $congé->du_date = request("du_date");
        $congé->au_date = request("au_date");
        $congé->user_id = $id;

        $congé->save();

        return redirect()->route("conges.index")->with("message", "congé ajouté !");
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
        $conge = Conge::findOrFail($id);
        return view("conges.edit")->with("conge", $conge);
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
        request()->validate([
            'motif' => ['required', 'string'],
            'user_id' => ['required'],
            'details' => ['required', 'string'],
            'montant' => ['numeric'],
            'du_date' => ['required', 'string', 'after:yesterday', 'before:au_date'],
            'au_date' => ['required', 'string', 'after:du_date'],
        ]);

        $congé = Conge::findOrFail($id);

        $congé->motif = request("motif");
        $congé->details = request("details");
        $congé->du_date = request("du_date");
        $congé->au_date = request("au_date");
        $congé->type = request("type");
        $congé->montant = request("montant");
        $congé->status = request("status");
        $congé->raison = request("raison");
        $congé->user_id = request("user_id");

        $congé->save();

        $user = User::findOrFail($id);

        // We dont want the user to notify themself when they make a change to their request
        if (!(auth()->user()->id == $id)) {
            $user->notify(new CongeNotification());
        }

        return redirect()->route("conges.index")->with("message", "demande éditée !");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $congé = Conge::findOrFail($id);
        $congé->delete();

        return redirect()->back()->with("message", "Congé supprimé");
    }


    public function changer_conge_status(Request $request){
        $id = request("congé_id");

        $congé = Conge::findOrFail($id);

        $congé->status = request("status");


        $congé->save();

        return redirect()->back();
    }
}
