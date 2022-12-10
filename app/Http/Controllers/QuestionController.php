<?php

namespace App\Http\Controllers;

use App\Jobs\AddQuestionJob;
use App\Jobs\DeleteQuestionJob;
use App\Jobs\UpdateQuestionIndexes;
use App\Jobs\UpdateQuestionJob;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function store(Request $request, Survey $survey)
    {
        AddQuestionJob::dispatch($survey, $request->question);
    }

    public function update(Request $request, Survey $survey, Question $question)
    {
        UpdateQuestionJob::dispatch($question, $request->all());
        return $question;
    }


    public function destroy(Request $request, Survey $survey, Question $question)
    {
        DeleteQuestionJob::dispatch($question);
        return;
    }
}
