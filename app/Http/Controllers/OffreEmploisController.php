<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OffreEmplois;
use App\Models\Application;


class OffreEmploisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $offres = OffreEmplois::latest()->get();
        return view("offres.index")->with("offres", $offres);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("offres.create");
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
            'description' => ['required', 'string'],
            'date_limite' => ['required'],
            'status' => ['required', 'string'],
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024'
        ]);

        $offre = new OffreEmplois;

        $offre->titre = request("titre");
        $offre->description = request("description");
        $offre->date_limite = request("date_limite");
        $offre->status = request("status");

        $filename = $request->image->getClientOriginalName();
        $request->image->storeAs('job_offers_images',$filename,'public');
        $offre->image = $filename;
        $offre->save();

        return redirect()->route("offres_emplois.index")->with("message", "offre crée avec succès");
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
        $offre = OffreEmplois::findOrFail($id);
        return view("offres.edit")->with("offre", $offre);
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
        $offre = OffreEmplois::findOrFail($id);

        if($request->hasFile('image')){

            request()->validate([
                'image' => 'image|mimes:jpeg,png,jpg|max:1024'
            ]);

            $filename = $request->profile_picture->getClientOriginalName();
            $request->profile_picture->storeAs('photos_profile',$filename,'public');
            $offre->update(['image'=>$filename]);
        }

        $offre->titre = request("titre");
        $offre->description = request("description");
        $offre->date_limite = request("date_limite");
        $offre->status = request("status");

        $offre->save();
        return redirect()->route("offres_emplois.index")->with("message", "offre modifié avec succès");
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
}
