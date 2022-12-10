<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'required' => 'boolean',
    ];

    public function survey(){
        return $this->belongsTo(Survey::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }
}
