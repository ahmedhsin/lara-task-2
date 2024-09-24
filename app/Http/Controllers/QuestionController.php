<?php

namespace App\Http\Controllers;

use App\Action\MakeJsonResponse;
use App\Http\Requests\QuestionFormRequest;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function main(string $id)
    {
        $questions = Question::query()->where('category_id','=',$id)->get();
        return view('Questions.main', [
            "questions" => $questions
        ]);
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
    public function store(QuestionFormRequest $request,string $id)
    {
        $data = $request->validated();
        $data['category_id'] = $id;
        if (isset($data['required'])){
            $data['required'] = true;
        }
        $ques = Question::query()->create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return MakeJsonResponse::make(Question::query()->where('category_id','=',$id)->get());
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
