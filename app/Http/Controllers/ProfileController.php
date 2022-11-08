<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        return view('profile.index')->with('user', $user);
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
        //
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
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'addresse' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'dob' => ['required'],
        ]);
        
        $user = User::findOrFail($id);
        $user->name = request('name');
        $user->surname = request('surname');
        $user->addresse = request('addresse');
        $user->phone = request('phone');
        $user->email = request('email');
        $user->dob = request('dob');

        if($request->hasFile('profile_picture')){

            request()->validate([
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:1024'
            ]);

            $filename = $request->profile_picture->getClientOriginalName();
            $request->profile_picture->storeAs('photos_profile',$filename,'public');
            $user->update(['profile_picture'=>$filename]);
        }

        $user->save();
        return redirect()->back();
    }

    public function supprimer_photo($id)
    {
        $user = User::findOrFail($id);
        $user->profile_picture = "user.png";

        $user->save();

        return redirect()->back();
    }

    public function changer_mdp(Request $request){

        request()->validate([
            'current_pwd' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::findOrFail(request()->user_id);
        
        if (Hash::check($request->current_pwd, $user->password)) { 
            $user->fill([
             'password' => Hash::make($request->password)
             ])->save();
             return redirect()->back()->with("message", "Vous avez changé votre mot de passe");
         } else {
             return redirect()->back()->with("message", "Mots de passent ne correspondent pas");
         }
    }


    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->profile_picture = "user.png";
    //     $user->save();
    //     return redirect()->back();
    // }

}
