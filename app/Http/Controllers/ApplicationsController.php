<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OffreEmplois;

use App\Models\Application;

class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'nom' => ['required', 'string'],
            'prénom' => ['required', 'string'],
            'date_de_naissance' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'phone' => ['required', 'string'],
            'addresse' => ['required', 'string'],
            'motivation' => ['required', 'string'],
            'cv' => ['required', 'mimes:pdf']
        ]);


        $application = new Application;

        $application->nom = request("nom");
        $application->prénom = request("prénom");
        $application->date_de_naissance = request("date_de_naissance");
        $application->email = request("email");
        $application->phone = request("phone");
        $application->addresse = request("addresse");
        $application->motivation = request("motivation");

        $filename = $request->cv->getClientOriginalName();
        $request->cv->storeAs('offres_public',$filename,'public');
        $application->cv = $filename;
        
        if($request->hasFile('autre_documents')){
            request()->validate([
                'autre_documents' => 'mimes:pdf',
            ]);
            
            $filename2 = $request->autre_documents->getClientOriginalName();
            $request->autre_documents->storeAs('offres_public',$filename2,'public');
            $application->autre_documents = $filename2;
        }

        $application->offre_emplois_id = request("offre_id");
        $application->save();

        return redirect()->route("offres_public")->with("message", "Votre application a été envoyé !");
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

        $application = Application::findOrFail($id);
        return view("applications.show")->with("application", $application);
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


    public function application($id)
    {
        $offre = OffreEmplois::findOrFail($id);
        return view("applications.create")->with("offre", $offre);
    }

    public function offre_applications($id){
        $offre = OffreEmplois::findOrFail($id);
        $offre_applications = $offre->applications;

        return view("applications.index")->with("offre_applications", $offre_applications);
    }
}
