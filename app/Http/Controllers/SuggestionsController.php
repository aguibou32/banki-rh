<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Notifications\SuggestionNotification;
use App\Models\User;

class SuggestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suggestions = Suggestion::latest()->paginate(20);
        return view("suggestions.index")->with("suggestions", $suggestions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("suggestions.create");
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
        ]);

        $user = Auth::user();

        $suggestion = new Suggestion;
        $suggestion->title = request("titre");
        $suggestion->details = request("details");
        $suggestion->user_id = $user->id;

        $suggestion->save();

        $users = User::all();

        foreach ($users as $user) {
            $user->notify(new SuggestionNotification());
        }

        return redirect()->route("suggestions.index")->with("message", "suggestion a été publié");
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
        $user = Auth::user();
        $suggestion = Suggestion::findOrFail($id);

        if (!($user->id == $suggestion->user_id)) {
            return redirect()->back();
        }else{
            return view("suggestions.edit")->with("suggestion", $suggestion);
        }
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
        $suggestion = Suggestion::findOrFail($id);

        if (!$user->id == $suggestion->user_id) {
            return redirect()->back();
        }else{
            request()->validate([
                'titre' => ['required', 'string', 'max:255'],
                'details' => ['required', 'string'],
            ]);

            $suggestion->title = request("titre");
            $suggestion->details = request("details");
            $suggestion->save();

            return redirect()->route("suggestions.index")->with("message", "suggestion modifiée !");
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suggestion = Suggestion::findOrFail($id);

        $user = Auth::user();
        $suggestion = Suggestion::findOrFail($id);

        if (!$user->id == $suggestion->user_id) {
            return redirect()->back();
        }else{
            $suggestion->delete();
            return redirect()->route("suggestions.index")->with("message", "suggestion effacée !");
        }
    }
}
