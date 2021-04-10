<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Employment;
use App\Models\Personal;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $personal = Personal::where('user_id',Auth::id())->first();
        $social = Social::where('user_id',Auth::id())->first();
        $skills = Skill::where('user_id',Auth::id())->get();
        $projects = Project::where('user_id',Auth::id())->get();
        $employments = Employment::where('user_id',Auth::id())->get();
        $educations = Education::where('user_id',Auth::id())->get();
        return view('home',compact('personal','social','skills','projects','employments','educations'));
    }
}
