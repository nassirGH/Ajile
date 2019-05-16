<?php

namespace App\Http\Controllers;

use App\Question;
use App\Questionnaire;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionnaireController extends Controller
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
        $questionnaires=Questionnaire::all();
        return view('pages.questionnaires.index',compact('questionnaires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams=Team::all();
        return view('pages.questionnaires.create',compact(['teams']));
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
            'name'=>'required|string',
            'teams'=>'required|array',
            'teams.*'=>'required|numeric',
            'number_questions'=>'required|numeric'
        ]);

        $questionnaire=new Questionnaire();
        $questionnaire->name=$request->name;
        $questionnaire->user_id=Auth::id();
        $questionnaire->save();

        foreach ($request->teams as $team){
            $questionnaire->teams()->attach($team);
        }

        for($i=0;$i<(int)$request->number_questions;$i++){
            $question=new Question();
            $question->questionnaire_id=$questionnaire->id;
            $question->question=$request->get('question-'.$i);
            $question->save();
        }

        return redirect()->back()->with('success','Questionnaire created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function show(Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function delete(Questionnaire $questionnaire,$id)
    {
        $questionnaire=Questionnaire::find($id);
        $questionnaire->delete();
        return redirect()->back()->with('success','Questionnaire deleted successfully');

    }
}
