<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware(function ($request, $next) {
            if(!Auth::user()->isAdminOrCoach())
                return redirect()->back();
            else
                return $next($request);
        });
    }

    public function index()
    {
        $teams=Team::all();
        return view('pages.teams.index',compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $owners=User::where('role','product_owner')->get();
        $developers=User::where('role','developer')->get();
        $masters=User::where('role','scrum_master')->get();

        return view('pages.teams.create',compact(['owners','developers','masters']));
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
          'scrum_master'=>['required','numeric'],
          'product_owner'=>['required','numeric'],
          'name'=>['required','string'],
          'developers'=>['required','array'],
          'developers.*'=>['required','numeric'],
       ]);
       $team=new Team();
       $team->name=$request->name;
       $team->save();
       $team->users()->attach($request->scrum_master,array('relation'=>'scrum_master'));
       $team->users()->attach($request->product_owner,array('relation'=>'product_owner'));
       foreach ($request->developers as $developer){
           $team->users()->attach($developer,array('relation'=>'developer'));
       }
        return redirect()->back()->with('success','Added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function delete(Team $team,$id)
    {
        $team=Team::find($id);
        $team->delete();
        return redirect()->back()->with('success','Deleted successfully');
    }
}
