<?php

namespace App\Repositories;

use App\Models\Survey;

class SurveyRepository
{
    public function getAll(){
        return Survey::with(['questions', 'responses.response_questions'])->get()->map->format();
    }

    public function getTrash(){
        return Survey::onlyTrashed('questions')->get();
    }


}
