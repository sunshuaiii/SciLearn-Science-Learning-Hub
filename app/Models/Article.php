<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    public $timestamps = false;

    // article->topic = *..1
    public function getTopic()
    {
        return $this->belongsTo(Topic::class);
    }

    // article->quiz = 1..1
    public function getQuiz()
    {
        return $this->hasOne(Quiz::class);
    }
}
