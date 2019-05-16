<?php

namespace App\Http\Controllers;

use App\Project;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!Auth::user()->isAdminOrCoach())
                return redirect()->back();
            else
                return $next($request);
        });
    }

    public function index()
    {
        $projects=Project::all();
        return view('pages.projects.index',compact(['projects']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams=Team::all();
        return view('pages.projects.create',compact(['teams']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|string',
            'description'=>'required|string',
            'team'=>'required|numeric',
            'department'=>'required|string',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after:start_date',
        ]);
        $project=new Project();
        $project->title=$request->title;
        $project->team_id=$request->team;
        $project->description=$request->description;
        $project->department=$request->department;
        $project->start_date=$request->start_date;
        $project->end_date=$request->end_date;
        $project->start_date=$request->start_date;
        $project->save();

        return redirect()->back()->with('success','Project Created Successfully');
    }
    public function delete(Project $project,$id)
    {
        $project=Project::find($id);
        $project->delete();
        return redirect()->back()->with('success','Deleted Successfully');
    }
}
