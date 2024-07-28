<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return Inertia::render('Questions');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $question =$request->all()['question'];
       $answers =$request->all()['answers'];
       $newQuestion = new Question;
       $newQuestion->question=$question;
       $newQuestion->save();

       foreach($answers as $answer){
            $newAnswer = new Answer;
            $newAnswer->answer=$answer['answer'];
            $newAnswer->correct_answer=$answer['correct_answer'];
            $newAnswer->question_id=$newQuestion->id;
            $newAnswer->save();
       }
       return redirect('/questions')->with('success','Thêm thành công !!!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
