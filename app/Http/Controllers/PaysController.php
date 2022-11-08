<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pays;

class PaysController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user->hasPermissionTo('voir pays')) {
            return redirect()->back();
        }
        
        $pays = Pays::all();
        return view("pays.index")->with("pays", $pays);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if (!$user->hasPermissionTo('editer pays')) {
            return redirect()->back();
        }

        return view("pays.create");
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
        if (!$user->hasPermissionTo('editer pays')) {
            return redirect()->back();
        }

        request()->validate([
            'name' => ['required', 'string', "unique:pays"],
        ]);

        $pays = new Pays;
        $pays->name = request("name");
        $pays->save();

        return redirect()->route("pays.index")->with("message", "Pays ajouté !");
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
        //
        $user = Auth::user();
        if (!$user->hasPermissionTo('editer pays')) {
            return redirect()->back();
        }

        $pays = Pays::findOrFail($id);
        return view("pays.edit")->with("pays", $pays);
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
        if (!$user->hasPermissionTo('editer pays')) {
            return redirect()->back();
        }

        request()->validate([
            'name' => ['required', 'string', "unique:pays"],
        ]);

        $pays = Pays::findOrFail($id);
        $pays->name = request("name");

        $pays->save();

        return redirect()->route("pays.index")->with("message", "pays modifié !");
        


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
        if (!$user->hasPermissionTo('editer pays')) {
            return redirect()->back();
        }

        $pays = Pays::findOrFail($id);
        $pays->delete();

        return redirect()->back();
    }
}
