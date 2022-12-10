<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Survey;
use App\Repositories\SurveyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $surveyRepository;
    public function __construct()
    {
        $this->surveyRepository  = new SurveyRepository();
    }


    public function index(Request $request)
    {
        if($request->onlyTrashed){
            return $this->surveyRepository->getTrash();
        }
        return $this->surveyRepository->getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['title' => 'required|unique:surveys,title']);
        $alpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

        $alpha_shuffle = Arr::shuffle(str_split($alpha));
        $alpha = join("", $alpha_shuffle);
        $survey = $request->user()->surveys()->create([
            'id' => substr($alpha, 0, 25),
            'title' => $request->title,
            'description' => $request->description ?? null,
            'folder_id' => $request->folder_id ?? null
        ]);
        $survey->load(['questions', 'responses.response_questions']);
        return $survey->format();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        $survey->load(['questions', 'responses.response_questions']);
        return $survey->format();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
       $request->validate(['title' => 'required' , 'unique:surveys,title']);
       $survey->title = $request->title;
       $survey->description = $request->description ?? '';
       $survey->save();
       return $survey;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        $survey->delete();

        return null;
    }

    public function trash(){
        return "example";
        dd("example");
        // return Survey::all();
    }
}
