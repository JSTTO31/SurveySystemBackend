<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Survey extends Model
{
    use HasFactory, SoftDeletes;
    public $incrementing = false;
    protected $keyType = "string";
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function questions(){
        return $this->hasMany(Question::class)->orderBy('index', 'ASC');
    }

    public function responses(){
        return $this->hasMany(Response::class);
    }

    public function format(){
        $surveyArr = collect($this);
        return [
            ...$surveyArr,
            "questions" => collect($surveyArr['questions'])->map(function($question){
                $response_questions = [];
                $properties = json_decode($question['properties'], true);

                if($properties["options"] ?? false){
                    $options = preg_split('/\r?\n/', $properties['options']);
                    foreach($options as $option){
                        $response_questions[$option] = ResponseQuestion::where('survey_id', $question['survey_id'])
                                                       ->where('question_id', $question['id'])
                                                       ->where('answer', $option)->get()->count();
                    }
                }else{
                    $response_questions = DB::table('response_questions')
                                        ->where('survey_id', $question['survey_id'])
                                        ->where('question_id', $question['id'])
                                        ->select('answer')
                                        ->get()->pluck('answer');
                }

                return [
                    ...$question,
                    'properties' => json_decode($question['properties']),
                    'response_questions' => $response_questions
                ];
            })
        ];
    }

}
