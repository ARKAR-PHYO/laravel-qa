<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\AskQuestionRequest;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index()
    {
        return view('questions.index', ['questions' =>Question::latest()->paginate(5)]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('questions.create', ['question' => new Question()]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(AskQuestionRequest $request)
    {
        $request->user()->questions()->create($request->only('title', 'body'));

        return redirect()->route('questions.index')->with('success', "Your Question Has Been Submitted!");
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Question  $question
    * @return \Illuminate\Http\Response
    */
    public function show(Question $question)
    {
        $question->increment('views');
        return view('questions.show', compact('question'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Question  $question
    * @return \Illuminate\Http\Response
    */
    public function edit(Question $question)
    {
        $this->authorize("update", $question);
        return view('questions.edit', compact('question'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Question  $question
    * @return \Illuminate\Http\Response
    */
    public function update(AskQuestionRequest $request, Question $question)
    {
        $this->authorize("update", $question);

        $question->update($request->only('title', 'body'));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => "Your Question Has Been Updated!",
                'body_html' => $question->body_html,
            ]);
        }

        return redirect('/questions')->with('success', "Your Question Has Been Updated!");
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Question  $question
    * @return \Illuminate\Http\Response
    */
    public function destroy(Question $question)
    {
        $this->authorize("delete", $question);

        $question->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'message' => "Your Question has been deleted"
            ]);
        }

        return redirect('/questions')->with('success', "Your Question has been deleted");
    }
}
