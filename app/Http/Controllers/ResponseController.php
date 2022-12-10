<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function store(Request $request, Survey $survey){
        $response = $survey->responses()->create();
        $response->response_questions()->createMany($request->questions);
        return $response;
    }
}
