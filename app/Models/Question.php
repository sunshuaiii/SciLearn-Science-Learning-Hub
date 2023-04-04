<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    public $timestamps = false;

    // question->quiz = *..1
    public function getQuiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
