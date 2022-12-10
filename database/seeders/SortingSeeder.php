<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Survey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SortingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $surveys = Survey::with('questions')->get();

        foreach($surveys as $survey){
            $questions = Question::where('survey_id', $survey->id)->get();
            $questions->each(function($question, $key){
                return $key;
            });
        }
    }
}
