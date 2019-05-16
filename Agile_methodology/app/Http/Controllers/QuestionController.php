<?php

namespace App\Http\Controllers;

use App\Question;
use App\Questionnaire;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware(function ($request, $next) {
            if(Auth::user()->isAdminOrCoach())
                return redirect()->back();
            else
                return $next($request);
        });
    }

    public function index()
    {
        $questionnaires=$this->getNotification();
        return view('pages.notifications.index', compact(['questionnaires']));

    }

    public function getNotification(){
        $teams = Auth::user()->teams;
        $temp_questions=Auth::user()->questions->toArray();
        $ans_questions=array();
        foreach ($temp_questions as $question){
            array_push($ans_questions,$question['id']);
        }
        $questionnaires=array();
        foreach ($teams as $team) {
            foreach ($team->questionnaires as $questionnaire) {
                $questions = array();
                foreach ($questionnaire->questions as $question) {
                    if (!in_array($question->id, $questions, true) && !in_array($question->id,$ans_questions,true)) {

                        array_push($questions, $question->id);
                    }
                }
                if(count($questions) > 0){
                    $questionnaires[$questionnaire->id]=$questions;
                }
            }
        }
        return $questionnaires;
    }
    public function show($id)
    {
        $questionnaires=$this->getNotification();
        $questionnaire=Questionnaire::find($id);
        if($questionnaire!=null)
         return view('pages.notifications.questions',compact(['questionnaire','questionnaires']));
        else return redirect()->back();
    }

    public function store(Request $request,$id){
        $this->validate($request,[
            'comment'=>'string|max:255',
            'questions'=>'required|array',
            'questions.*'=>'required|string',
        ]);

        $questionnaire=Questionnaire::find($id);
        $questionnaire->users()->attach(auth()->id(),array('comment'=>$request->comment));
        foreach ($request->questions as $question){
            $temp=explode('/',$question);
            $quest=Question::find($temp[1])->users()->attach(Auth::id(),array('rate'=>$temp[0]));
        }
        return redirect()->back()->with('success','Questionnaire Answered');
    }

}
