<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Rapport;
use PDF;

class RapportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user->hasPermissionTo('editer rapports')) {
            $rapports = $user->rapports()->latest()->get();
            return view("rapports.index")->with("rapports", $rapports);
        }
        else{
            $rapports = Rapport::all();
            return view("rapports.index")->with("rapports", $rapports);
        }
    }

    /**
     * Show the form for creating a new resource.
    *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("rapports.create");
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
            'type' => ['required', 'string'],
            'date' => ['required', 'date', 'before:tomorrow'],
            'title' => ['required', 'string'],
            'service' => ['required', 'string'],
            'content' => ['required', 'string'],
        ]);

        $rapport = new Rapport;

        if($request->hasFile('rapport_fichier')){
            request()->validate([
                'rapport_fichier' => 'mimes:word,pdf|max:2048'
            ]);

            $filename = $request->rapport_fichier->getClientOriginalName();
            $request->rapport_fichier->storeAs('rapports',$filename, 'public');

        }

        $user = Auth::user();

        $rapport->type = request("type");
        $rapport->title = request("title");
        $rapport->date = request("date");
        $rapport->content = request("content");
        $rapport->rapport_file = $filename;
        $rapport->service_id = $user->service->id;
        $rapport->user_id = $user->id;

        $rapport->save();
        return redirect()->route("rapports.index")->with("message", "rapport enregistré !");
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
        $rapport = Rapport::findOrFail($id);

        if (!($user->id == $rapport->user_id)) {
            return redirect()->back();
        }else{
            return view("rapports.show")->with("rapport", $rapport);
        }
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
        $rapport = Rapport::findOrFail($id);

        if (!($user->id == $rapport->user_id)) {
            return redirect()->back();
        }else{
            return view("rapports.edit")->with("rapport", $rapport);
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
        $rapport = Rapport::findOrFail($id);

        if (!($user->id == $rapport->user_id)) {
            return redirect()->back();
        }else{
            $rapport->type = request("type");
            $rapport->title = request("title");
            $rapport->date = request("date");
            $rapport->content = request("content");
            $rapport->service_id = $user->service->id;
            $rapport->user_id = $user->id;
    
            $rapport->save();
            return redirect()->route("rapports.index")->with("message", "rapport modifié !");
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
        $rapport = Rapport::findOrFail($id);
        $rapport->delete();
        return redirect()->back()->with("message", "rapport supprimé !");
    }

    public function generateRepportPdf($id){

        $user = Auth::user();
        $rapport = Rapport::findOrFail($id);

        if (!($user->id == $rapport->user_id)) {
            return redirect()->back();
        }else{
            $data = [
                'name' => $rapport->user->name,
                'surname' => $rapport->user->surname,
                'type' => $rapport->type,
                'date' => $rapport->date,
                'title' => $rapport->title,
                'content' => $rapport->content,
            ];
              
            $pdf = PDF::loadView('rapports.generate_repport', $data);
            return $pdf->download('rapport'.'_'.$rapport->user->name.'_'.$rapport->user->surname.'_'.$rapport->date.'.pdf');
        }
        
    }


    public function telecharger_fichier_rapport($file_name) {
        $file_path = public_path('storage/rapports/'.$file_name);
        return response()->download($file_path);
    }
}
