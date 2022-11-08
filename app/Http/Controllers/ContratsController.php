<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Contrat;
    
use App\Models\User;
use Carbon\Carbon;
use PDF;

class ContratsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if (!($user->hasPermissionTo('voir contrats'))) {
            return redirect()->back();
        }

        $contrats = Contrat::all();
        return view("contrats.index")->with("contrats", $contrats);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if (!($user->hasPermissionTo('editer contrats'))) {
            return redirect()->back();
        }

        // over here, we only want to get the users that do not have contracts
        $users = User::doesnthave('contrat')->whereNotIn('name', ['Super'])->get();

        $users2 = User::whereNotIn('name', ['Super'])->get();

        return view("contrats.create")->with("users", $users)->with("users2", $users2);
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
        if (!($user->hasPermissionTo('editer contrats'))) {
            return redirect()->back();
        }
        
        request()->validate([
            'type' => ['required', 'string', 'max:255'],
            'debut' => ['required', 'string', 'max:255'],
            'fin' => ['required', 'string', 'max:255'],
            'heure_debut' => ['required', 'string', 'max:255'],
            'heure_fin' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'string', 'max:255'], // employee_id
            'horraire' => ['required', 'integer'],
            'salaire_de_base' => ['required', 'integer'],
            'responsable_id' => ['required', 'string', 'max:255'],
            'fonctions' => ['required', 'string'],
            'signe_par_id' => ['required', 'string', 'max:255'],
        ]);

        if(request()->has("logement")){
            request()->validate([
                'logement' => 'integer']);
        }

        if(request()->has("transport")){
            request()->validate([
                'transport' => 'integer']);
        }

        $contrat = new Contrat;

        $contrat->type = request("type");
        $contrat->debut = request("debut");
        $contrat->fin = request("fin");
        $contrat->heure_debut = request("heure_debut");
        $contrat->heure_fin = request("heure_fin");
        $contrat->user_id = request("user_id");
        $contrat->horraire = request("horraire");
        $contrat->salaire_de_base = request("salaire_de_base");
        $contrat->logement = request("logement");
        $contrat->transport = request("transport");
        $contrat->responsable_id = request("responsable_id");
        $contrat->fonctions = request("fonctions");
        $contrat->signe_par_id = request("signe_par_id");

        $contrat->save();    
        return redirect()->route("contrats.index")->with("message", "contrat enregistré !");
        
    }

    public function generate_contrat($id){

        $user = Auth::user();
        if (!($user->hasPermissionTo('editer contrats'))) {
            return redirect()->back();
        }


        $contrat = Contrat::findOrFail($id);

        return $contrat->debut;
        
        $data = [
            'employee_name' => $contrat->user->name,
            'employee_surname' => $contrat->user->surname,
            'employee_role' => $contrat->user->role,
            'employee_dob' => $contrat->user->dob,
            'employee_matricule' => $contrat->user->matricule,
            'employee_id_number' => $contrat->user->id_number,
            'employee_nationality' => $contrat->user->nationality,
            'employee_email' => $contrat->user->email,
            'employee_addresse' => $contrat->user->addresse,
            'employee_phone' => $contrat->user->phone,
            'type_of_contract' => $contrat->type,
            'horraire' => $contrat->horraire,
            'salaire_de_base' => $contrat->salaire_de_base,
            'logement' => $contrat->logement,
            'transport' => $contrat->transport,
            'debut' => $contrat->debut,
            'fin' => $contrat->fin,
            'fonctions' => $contrat->fonctions,
        ];

        $pdf = PDF::loadView('contrats.generate_contrat', $data);
        return $pdf->download('contrat'.'_'.$contrat->user->name.'_'.$contrat->user->surname.'_'.$contrat->date.'.pdf');

    }


    public function generate_stage($id){

        $user = Auth::user();
        if (!($user->hasPermissionTo('editer contrats'))) {
            return redirect()->back();
        }

        $contrat = Contrat::findOrFail($id);

        $responsable = User::findOrFail($contrat->responsable_id);

        $data = [
            'employee_name' => $contrat->user->name,
            'employee_surname' => $contrat->user->surname,
            'employee_phone' => $contrat->user->phone,
            'employee_role' => $contrat->user->role,
            'employee_dob' => $contrat->user->dob,
            'employee_matricule' => $contrat->user->matricule,
            'employee_id_number' => $contrat->user->id_number,
            'employee_nationality' => $contrat->user->nationality,
            'employee_email' => $contrat->user->email,
            'employee_addresse' => $contrat->user->addresse,
            'employee_phone' => $contrat->user->phone,
            'responsable_name' => $responsable->name . '' . $responsable->surname,
            'type_of_contract' => $contrat->type,
            'horraire' => $contrat->horraire,
            'salaire_de_base' => $contrat->salaire_de_base,
            'logement' => $contrat->logement,
            'transport' => $contrat->transport,
            'debut' => $contrat->debut,
            'fin' => $contrat->fin,
            'heure_debut' => $contrat->heure_debut,
            'heure_fin' => $contrat->heure_fin,

            'created_at' => $contrat->created_at,


            'fonctions' => $contrat->fonctions,
        ];

        $pdf = PDF::loadView('contrats.generate_stage', $data);
        
        return $pdf->download('contrat_de_stage'.'_'.$contrat->user->name.'_'.$contrat->user->surname.'_'.$contrat->date.'.pdf');


        return redirect()->route("contrats.index")->with("message", "contrat de stage generé !");

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
        if (!($user->hasPermissionTo('editer contrats'))) {
            return redirect()->back();
        }

        $contrat = Contrat::findOrFail($id);
        $users = User::whereNotIn('name', ['Super'])->get();

        return view("contrats.edit")->with("contrat", $contrat)->with("users", $users);
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
        if (!($user->hasPermissionTo('editer contrats'))) {
            return redirect()->back();
        }
        
        request()->validate([
            'type' => ['required', 'string', 'max:255'],
            'debut' => ['required', 'string', 'max:255'],
            'fin' => ['required', 'string', 'max:255'],
            'heure_debut' => ['required', 'string', 'max:255'],
            'heure_fin' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'string', 'max:255'], // employee_id
            'horraire' => ['required', 'integer'],
            'salaire_de_base' => ['required', 'integer'],
            'responsable_id' => ['required', 'string', 'max:255'],
            'fonctions' => ['required', 'string'],
            'signe_par_id' => ['required', 'string', 'max:255'],
        ]);

        if(request()->has("logement")){
            request()->validate([
                'logement' => 'integer']);
        }

        if(request()->has("transport")){
            request()->validate([
                'transport' => 'integer']);
        }

        $contrat = Contrat::findOrFail($id);
        
        $contrat->type = request("type");
        $contrat->debut = request("debut");
        $contrat->fin = request("fin");
        $contrat->heure_debut = request("heure_debut");
        $contrat->heure_fin = request("heure_fin");
        $contrat->user_id = request("user_id");
        $contrat->horraire = request("horraire");
        $contrat->salaire_de_base = request("salaire_de_base");
        $contrat->logement = request("logement");
        $contrat->transport = request("transport");
        $contrat->responsable_id = request("responsable_id");
        $contrat->fonctions = request("fonctions");
        $contrat->signe_par_id = request("signe_par_id");

        $contrat->save();    

        $data = [
            'employee_name' => $contrat->user->name,
            'employee_surname' => $contrat->user->surname,
            'employee_role' => $contrat->user->role,
            'employee_dob' => $contrat->user->dob,
            'employee_matricule' => $contrat->user->matricule,
            'employee_id_number' => $contrat->user->id_number,
            'employee_nationality' => $contrat->user->nationality,
            'employee_email' => $contrat->user->email,
            'employee_addresse' => $contrat->user->addresse,
            'employee_phone' => $contrat->user->phone,
            'type_of_contract' => $contrat->type,
            'horraire' => $contrat->horraire,
            'salaire_de_base' => $contrat->salaire_de_base,
            'logement' => $contrat->logement,
            'transport' => $contrat->transport,
            'debut' => $contrat->debut,
            'fin' => $contrat->fin,
            'fonctions' => $contrat->fonctions,
        ];

        $pdf = PDF::loadView('contrats.generate_contrat', $data);
        $pdf->download('contrat'.'_'.$contrat->user->name.'_'.$contrat->user->surname.'_'.$contrat->date.'.pdf');

        return redirect()->route("contrats.index")->with("message", "Contrat modifié !");
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
        if (!($user->hasPermissionTo('editer contrats'))) {
            return redirect()->back();
        }
        
        $contrat = Contrat::findOrFail($id);
        $contrat->delete();
        return redirect()->route("contrats.index")->with("message", "Contrat supprimé !");
    }
}
