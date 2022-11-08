<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Departement;
use App\Models\User;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        if (!$user->hasPermissionTo('voir services')) {
            return redirect()->back();
        }

        $services = Service::all();
        return view("services.index")->with("services", $services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = Auth::user();
        if (!$user->hasPermissionTo('editer services')) {
            return redirect()->back();
        }

        $users = User::whereNotIn('name', ['Super'])->get();
        $départements = Departement::all();
        return view("services.create")->with("users", $users)
                                      ->with("départements", $départements);
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
        if (!$user->hasPermissionTo('editer services')) {
            return redirect()->back();
        }

        request()->validate([
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'user_id' => ['required'],
            'département_id' => ['required']
        ]);
        $service = new Service;
        $service->name = request("nom");
        $service->description = request("description");
        $service->user_id = request("user_id");
        $service->departement_id = request("département_id");

        $service->save();
        return redirect()->route("services.index")->with("message", "Service ajouté");
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

        $service = Service::first();
        return $service->responsable->name;        

        $user = Auth::user();
        if (!$user->hasPermissionTo('voir services')) {
            return redirect()->back();
        }

        return back();
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
        if (!$user->hasPermissionTo('voir services')) {
            return redirect()->back();
        }

        $users = User::whereNotIn('name', ['Super'])->get();
        $départements = Departement::all();
        $service = Service::findOrFail($id);
        return view("services.edit")->with("service", $service)
                                    ->with("users", $users)
                                    ->with("départements", $départements);
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
        $user = Auth::user();
        if (!$user->hasPermissionTo('voir services')) {
            return redirect()->back();
        }

        // return request()->all();


        request()->validate([
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'responsable_id' => ['required'],
            'département_id' => ['required']
        ]);

        $service = Service::findOrFail($id);
        $service->name = request("nom");
        $service->description = request("description");
        $service->responsable_id = request("responsable_id");
        $service->departement_id = request("département_id");

        $service->save();
        return redirect()->route("services.index")->with("message", "Service modifié");
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
        $user = Auth::user();
        if (!$user->hasPermissionTo('voir services')) {
            return redirect()->back();
        }

        $service = Service::findOrFail($id);

        $service->delete();
        return redirect()->back()->with("message", "service a été supprimé !");
    }
}
