<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Departement;
use App\Models\Division;
use App\Models\User;
use Illuminate\Http\Request;

class DepartementsController extends Controller
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

        if (!$user->hasPermissionTo('voir departements')) {
            return redirect()->back();
        }else{
            $départements = Departement::latest()->get();
            return view("departements.index")->with("départements", $départements);
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

        if (!$user->hasPermissionTo('editer departements')) {
            return redirect()->back();
        }
        
        $users = User::whereNotIn('name', ['Super'])->get();
        $divisions = Division::all();

        return view("departements.create")->with("users", $users)
                                          ->with("divisions", $divisions);
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

        if (!$user->hasPermissionTo('editer departements')) {
            return redirect()->back();
        }

        request()->validate([
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'responsable_id' => ['required'],
            'division_id' => ['required']
        ]);

        $département = new Departement;
        $département->name = request("nom");
        $département->description = request("description");
        $département->division_id = request("division_id");
        $département->responsable_id = request("responsable_id");

        $département->save();
        return redirect()->route("departements.index")->with("message", "Département ajouté");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        if (!$user->hasPermissionTo('editer departements')) {
            return redirect()->back();
        }

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

        if (!$user->hasPermissionTo('editer departements')) {
            return redirect()->back();
        }

        $users = User::whereNotIn('name', ['Super'])->get();
        $divisions = Division::all();
        $département = Departement::findOrFail($id);
        return view("departements.edit")->with("département", $département)
                                        ->with("users", $users)
                                        ->with("divisions", $divisions);
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

        if (!$user->hasPermissionTo('editer departements')) {
            return redirect()->back();
        }

        $département = Departement::findOrFail($id);
        $département->name = request("nom");
        $département->description = request("description");
        $département->responsable_id = request("responsable_id");
        $département->division_id = request("division_id");
        $département->save();

        return redirect()->route("departements.index")->with("message","département modifié avec succès !");
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

        if (!$user->hasPermissionTo('editer departements')) {
            return redirect()->back();
        }
        
        $département = Departement::findOrFail($id);

        if($département->services()->count()){
            return back()->withErrors(['error'=> "Supression impossible, ce département a des services"]);
        }

        $département->delete();
        return redirect()->back()->with("message", "département a été supprimé !");
    }
}
