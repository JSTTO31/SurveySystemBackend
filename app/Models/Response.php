<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;
    protected $fillable = ['survey_id'];

    public function response_questions(){
        return $this->hasMany(ResponseQuestion::class);
    }

    public function survey(){
        return $this->belongsTo(Survey::class);
    }
}
