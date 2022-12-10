<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // for ($i=0; $i < 5; $i++) {
        //     Survey::factory()->has(Question::factory()->state(function(array $attributes, Survey $survey){
        //         return [
        //             'survey_id' => $survey->id,
        //         ];
        //     })->count(10)->has(Answer::factory()->state(function(array $attributes, Question $question){
        //         return [
        //             'question_index' => $question->index,
        //             'survey_id' => $question->survey_id
        //         ];
        //     })->count(4)))->create();
        // }

        Schema::dropIfExists("answers");

    }
}
