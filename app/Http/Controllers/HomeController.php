<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\Annonce;
use App\Models\Avertissement;
use App\Models\Division;
use App\Models\Departement;
use App\Models\Service;

use App\Models\Conge;
use App\Models\User;

use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usersCount = User::whereNotIn('name', ['Super'])->get()->count();
        $departmentsCount = Departement::all()->count();
        $absencesCount = Absence::all()->count();
        $servicesCount = Service::all()->count();
        $divisionsCount = Division::all()->count();

        $result = DB::select(DB::raw("SELECT count(genre) as nombre,genre from users group by genre"));
    // dd($result);
        $data = "";
        foreach ($result as$val) {
            $data.="['".$val->genre."', ".$val->nombre."],";
        }
        // dd($data);
        $chartData = $data;

        return view('home')->with("chartData", $chartData)
                            ->with("usersCount", $usersCount)
                            ->with("absencesCount", $absencesCount)
                            ->with("divisionsCount", $divisionsCount)
                            ->with("departmentsCount", $departmentsCount)
                            ->with("servicesCount", $servicesCount);
    }
}
