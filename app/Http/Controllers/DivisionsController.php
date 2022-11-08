<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Departement;
use App\Models\Division;
use App\Models\User;

class DivisionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('password.confirm', ['only' => ['create', 'store', 'update', 'destroy']] );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        if (!$user->hasPermissionTo('voir divisions')) {
            return redirect()->back();
        }
        $divisions = Division::all();
        return view("divisions.index")->with("divisions", $divisions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if (!$user->hasPermissionTo('editer divisions')) {
            return redirect()->back();
        }

        $users = User::whereNotIn('name', ['Super'])->get();
        return view("divisions.create")->with("users", $users);
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
        if (!$user->hasPermissionTo('editer divisions')) {
            return redirect()->back();
        }
        request()->validate([
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'responsable_id' => ['required']
        ]);

        $division =  new Division;
        $division->name = request("nom");
        $division->description = request("description");
        $division->responsable_id = request("responsable_id");

        $division->save();
        return redirect()->route("divisions.index")->with("message", "Division enregistrée !");
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
        $user = Auth::user();
        if (!$user->hasPermissionTo('editer divisions')) {
            return redirect()->back();
        }
        $division = Division::findOrFail($id);
        $users = User::whereNotIn('name', ['Super'])->get();

        return view("divisions.edit")->with("division", $division)
                                     ->with("users", $users);
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
        if (!$user->hasPermissionTo('editer divisions')) {
            return redirect()->back();
        }
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'responsable_id' => ['required']
        ]);

        $division = Division::findOrFail($id);

        $division->name = request("name");
        $division->description = request("description");
        $division->responsable_id = request("responsable_id");

        $division->save();
        return redirect()->route("divisions.index")->with("message", "Division modifiée !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $division = Division::findOrFail($id);

        if($division->départements()->count()){
            return back()->withErrors(['error'=> "Supression impossible, cette division a des départements" ]);
        }

        $division->delete();
        return redirect()->back()->with("message", "division a été supprimé !");
    }
}
