<?php

namespace App\Http\Controllers;

use App\Notifications\AvertissementNotification;
use Illuminate\Support\Facades\Auth;
use App\Models\Avertissement;
use Illuminate\Http\Request;
use App\Models\User;

class AvertissementsController extends Controller
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
        if (!$user->hasPermissionTo('voir avertissements')) {
            $avertissements = $user->avertissements;
            return view("avertissements.index")->with("avertissements", $avertissements);
        }
        else if($user->hasPermissionTo('voir avertissements')){
            $avertissements = Avertissement::all();
            return view("avertissements.index")->with("avertissements", $avertissements);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->hasPermissionTo('editer avertissements')) {
            $users = User::whereNotIn('name', ['Super'])->get();
            return view("avertissements.create")->with("users", $users);
        }else{
            return redirect()->back();
        }
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
            'details' => ['required', 'string'],
            'severité' => ['required', 'string'],
            'user_id' => ['required'],
        ]);

        $avertissement = new Avertissement;
        $avertissement->titre = request("titre");
        $avertissement->details = request("details");
        $avertissement->severité = request("severité");
        $avertissement->user_id = request("user_id");

        $avertissement->save();

        $user = User::findOrFail(request("user_id"));

        $user->notify(new AvertissementNotification());

        return redirect()->route("avertissements.index")->with("utilisateur averti");
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
        $avertissement = Avertissement::findOrFail($id);
        $users = User::whereNotIn('name', ['Super'])->get();
        return view("avertissements.edit")->with("avertissement", $avertissement)
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
        request()->validate([
            'titre' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string'],
            'severité' => ['required', 'string'],
            'user_id' => ['required'],
        ]);

        $avertissement = Avertissement::findOrFail($id);

        $avertissement->titre = request("titre");
        $avertissement->details = request("details");
        $avertissement->severité = request("severité");
        $avertissement->user_id = request("user_id");

        $avertissement->save();

        return redirect()->route("avertissements.index")->with("message", "avertissement modifiée");
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
