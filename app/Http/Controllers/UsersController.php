<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\User;
use App\Models\Pays;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Exports\UsersExport;
use App\Imports\UsersImport;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('password.confirm', ['only' => ['create', 'store']] );
    }

    public function index()
    {
        $this->middleware('password.confirm');

        $user = Auth::user();
        if (!$user->hasPermissionTo('voir employes')) {
            return redirect()->back();
        }
        $users = User::whereNotIn('name', ['Super'])->latest()->get();
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function create()
    {
        $this->middleware('password.confirm');

        $user = Auth::user();
        if (!$user->hasPermissionTo('editer employes')) {
            return redirect()->back();
        }

        $services = Service::all();
        $pays = Pays::all();
        return view("users.create")->with("services", $services)
                                   ->with("pays", $pays);
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
        if (!$user->hasPermissionTo('editer employes')) {
            return redirect()->back();
        }
        request()->validate([
            'matricule' => ['required', 'string', 'max:255', 'unique:users'],
            'id_number' => ['required', 'string', 'max:255', 'unique:users'],
            'genre' => ['required', 'string', 'max:255'],
            'nationality' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'before:now'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string'],
            'addresse' => ['required', 'string'],
            'pays' => ['required'],
            'type_employé' => ['required'],
            'role' => ['required', 'string'],
            'description' => ['required', 'string'],
            "date_du_debut" => ['required'],
        ]);

        $user = new User;

        if($request->hasFile('profile_picture')){

            request()->validate([
                'profile_picture' => 'image|mimes:jpeg,png,jpg|max:1024'
            ]);

            $filename = $request->profile_picture->getClientOriginalName();
            $request->profile_picture->storeAs('photos_profile',$filename,'public');
            $user->update(['profile_picture'=>$filename]);
        }

        if(request('file1_name') || $request->hasFile("file1")){
            request()->validate([
                'file1_name' => ['required', 'string'],
                'file1' => ['required', 'mimes:pdf'],
            ]);

            $user->file1_name = request("file1_name");

            $file1 = $request->file1->getClientOriginalName();
            $request->file1->storeAs('fichiers_utilisateur',$file1,'public');
            $user->file1 = $file1;
        }

        if(request('file2_name') || $request->hasFile("file2")){
            request()->validate([
                'file2_name' => ['required', 'string'],
                'file2' => ['required', 'mimes:pdf']
            ]);

            $user->file2_name = request("file2_name");

            $file2 = $request->file2->getClientOriginalName();
            $request->file2->storeAs('fichiers_utilisateur',$file2,'public');
            $user->file2 = $file2;
        }

        if(request('file3_name') || $request->hasFile("file3")){
            request()->validate([
                'file3_name' => ['required', 'string'],
                'file3' => ['required', 'mimes:pdf']
            ]);

            $user->file3_name = request("file3_name");

            $file3 = $request->file3->getClientOriginalName();
            $request->file3->storeAs('fichiers_utilisateur',$file3,'public');
            $user->file3 = $file3;
        }

        if(request('file4_name') || $request->hasFile("file4")){
            request()->validate([
                'file4_name' => ['required', 'string'],
                'file4' => ['required', 'mimes:pdf']
            ]);

            $user->file4_name = request("file4_name");

            $file4 = $request->file4->getClientOriginalName();
            $request->file4->storeAs('fichiers_utilisateur',$file4,'public');
            $user->file4 = $file4;
        }

        if(request('file5_name') || $request->hasFile("file4")){
            request()->validate([
                'file5_name' => ['required', 'string'],
                'file4' => ['required', 'mimes:pdf']
            ]);

            $user->file5_name = request("file5_name");

            $file5 = $request->file5->getClientOriginalName();
            $request->file5->storeAs('fichiers_utilisateur',$file5,'public');
            $user->file5 = $file5;
        }

        if(request('file6_name') || $request->hasFile("file6")){
            request()->validate([
                'file6_name' => ['required', 'string'],
                'file6' => ['required', 'mimes:pdf']
            ]);

            $user->file6_name = request("file6_name");

            $file6 = $request->file6->getClientOriginalName();
            $request->file6->storeAs('fichiers_utilisateur',$file6,'public');
            $user->file6 = $file6;
        }

        // return request()->all();


        $user->matricule = request('matricule');
        $user->id_number = request('id_number');
        $user->genre = request('genre');
        $user->nationality = request('nationality');
        $user->name = request('name');
        $user->surname = request('surname');
        $user->dob = request('dob');
        $user->email = request('email');
        $user->phone = request('phone');
        $user->addresse = request('addresse');
        $user->pays = request('pays');
        $user->type_employé = request('type_employé');
        $user->role = request('role');
        $user->description = request('description');
        $user->date_du_debut = request('date_du_debut');
        $user->service_id = request("service_id");

        $user->password = bcrypt('Banki2022');
        $user->save();
        return redirect()->route("users.index")->with('message', 'Employé ajouté');

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
        if (!$user->hasPermissionTo('voir employes')) {
            return redirect()->back();
        }

        $user = User::findOrFail($id);
        $services = Service::all();
        $pays = Pays::all();


        $roles = Role::whereNotIn('name', ['Super Admin'])->get();;
        $permissions = Permission::all();
        
        return view("users.show")->with("user", $user)
                                 ->with("services", $services)
                                 ->with("roles", $roles)
                                 ->with("pays", $pays)
                                 ->with("permissions", $permissions);
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
        return redirect()->back();
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
        if (!$user->hasPermissionTo('editer employes')) {
            return redirect()->back();
        }

        $user2 = User::findOrFail(request("user_id"));
        request()->validate([
            'matricule' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user2->id)],
            'id_number' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user2->id) ],
            'genre' => ['required', 'string', 'max:255'],
            'nationality' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'dob' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user2->id)],
            'phone' => ['required', 'string'],
            'addresse' => ['required', 'string'],
            'pays' => ['required'],
            'type_employé' => ['required'],
            'role' => ['required', 'string'],
            'description' => ['required', 'string'],
            "date_du_debut" => ['required'],
        ]);

        $user = User::findOrFail(request("user_id"));

        if($request->hasFile('profile_picture')){

            request()->validate([
                'profile_picture' => 'image|mimes:jpeg,png,jpg|max:1024'
            ]);

            $filename = $request->profile_picture->getClientOriginalName();
            $request->profile_picture->storeAs('photos_profile',$filename,'public');
            $user->update(['profile_picture'=>$filename]);
        }

        if(request('file1_name') || $request->hasFile("file1")){
            request()->validate([
                'file1_name' => ['required', 'string'],
                'file1' => ['required', 'mimes:pdf'],
            ]);

            $user->file1_name = request("file1_name");

            $file1 = $request->file1->getClientOriginalName();
            $request->file1->storeAs('fichiers_utilisateur',$file1,'public');
            $user->file1 = $file1;
        }

        if(request('file2_name') || $request->hasFile("file2")){
            request()->validate([
                'file2_name' => ['required', 'string'],
                'file2' => ['required', 'mimes:pdf']
            ]);

            $user->file2_name = request("file2_name");

            $file2 = $request->file2->getClientOriginalName();
            $request->file2->storeAs('fichiers_utilisateur',$file2,'public');
            $user->file2 = $file2;
        }

        if(request('file3_name') || $request->hasFile("file3")){
            request()->validate([
                'file3_name' => ['required', 'string'],
                'file3' => ['required', 'mimes:pdf']
            ]);

            $user->file3_name = request("file3_name");

            $file3 = $request->file3->getClientOriginalName();
            $request->file3->storeAs('fichiers_utilisateur',$file3,'public');
            $user->file3 = $file3;
        }

        if(request('file4_name') || $request->hasFile("file4")){
            request()->validate([
                'file4_name' => ['required', 'string'],
                'file4' => ['required', 'mimes:pdf']
            ]);

            $user->file4_name = request("file4_name");

            $file4 = $request->file4->getClientOriginalName();
            $request->file4->storeAs('fichiers_utilisateur',$file4,'public');
            $user->file4 = $file4;
        }

        if(request('file5_name') || $request->hasFile("file4")){
            request()->validate([
                'file5_name' => ['required', 'string'],
                'file4' => ['required', 'mimes:pdf']
            ]);

            $user->file5_name = request("file5_name");

            $file5 = $request->file5->getClientOriginalName();
            $request->file5->storeAs('fichiers_utilisateur',$file5,'public');
            $user->file5 = $file5;
        }

        if(request('file6_name') || $request->hasFile("file6")){
            request()->validate([
                'file6_name' => ['required', 'string'],
                'file6' => ['required', 'mimes:pdf']
            ]);
            $user->file6_name = request("file6_name");

            $file6 = $request->file6->getClientOriginalName();
            $request->file6->storeAs('fichiers_utilisateur',$file6,'public');
            $user->file6 = $file6;
        }
        
        $user->matricule = request('matricule');
        $user->id_number = request('id_number');
        $user->nationality = request('nationality');
        $user->genre = request('genre');
        $user->name = request('name');
        $user->surname = request('surname');
        $user->dob = request('dob');
        $user->email = request('email');
        $user->phone = request('phone');
        $user->addresse = request('addresse');
        $user->pays = request('pays');
        $user->type_employé = request('type_employé');
        $user->role = request('role');
        $user->description = request('description');
        $user->date_du_debut = request('date_du_debut');
        $user->service_id = request("service_id");
        $user->password = bcrypt('Banki2022');

        $user->update();
        return redirect()->route("users.index")->with('message', "Données de l'employé modifiées");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with("message", "Utilisateur a été supprimé !");

    }


    // public function assignRole(Request $request, $id){
    //     return $request->all();
    // }


    public function assignRole(Request $request, $id){

        request()->validate([
            'role2' => ['required', 'string'],
        ]);

        $user = User::findOrFail($id);

        if($user->hasRole($request->role2)){
            return redirect()->back()->with("message", "l'utilisateur a déja ce rôle !"); 
        }

        $user->assignRole($request->role2);
        return redirect()->back()->with("message", "role a été ajouté à cet utilisateur !"); 

    }

    public function removeRole($id, $role_id){
        $user = User::findOrFail($id);
        $role = Role::findOrFail($role_id);

        if($user->hasRole($role)){
            $user->removeRole($role);
            return redirect()->back()->with("message","role a été revoqué à cet utilisateur");
        }
        else{
            return redirect()->back()->with("message","role n'existe pas");
        }
    }

    public function givePermission(Request $request, $id){

        $user = User::findOrFail($id);

        if($user->hasPermissionTo($request->permission)){
            return redirect()->back()->with("message", "L'utilisateur a déjà cette permission !"); 
        }

        $user->givePermissionTo($request->permission);
        return redirect()->back()->with("message", "permission ajouté à l'utilisateur !"); 

    }

    public function revokePermission($id, $permission_id){
        $user = User::findOrFail($id);
        $permission = Permission::findOrFail($permission_id);

        if($user->hasPermissionTo($permission)){
            $user->revokePermissionTo($permission);
            return redirect()->back()->with("message","permission revoqué à l'utlisateur");
        }
    }

    public function activer_desactiver_utilisateur(Request $request){

        request()->validate([
            'user_id' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();
        if (!$user->hasPermissionTo('activater desactiver utilisateur')) {
            return redirect()->back();
        }else{
            $id = request("user_id");
            $user = User::findOrFail($id);
            $status = request("status");
            $user->status = $status;
            $user->save();

            return redirect()->route("users.index")->with("message", "Vous avez changer le status de l'utilisateur");
        }
    }

    public function resetPassword(Request $request){
        $user = Auth::user();
        if (!$user->hasPermissionTo('réinitialiser mot de passe')) {
            return redirect()->back();
        }else{
            $id = request("user_id");
            $user = User::findOrFail($id);
            $password = Hash::make("Banki2022");
            $user->password = $password;
            $user->save();

            return redirect()->route("users.index")->with("message", "Vous avez reinitialiser le mot de passe de l'utilisateur");
        }
    }

}
