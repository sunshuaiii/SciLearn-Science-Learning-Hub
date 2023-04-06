<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    public $timestamps = false;

    // quiz->user = *..*
    public function getUsers()
    {
        return $this->belongsToMany(User::class);
    }

    // quiz->question = 1..*
    public function getQuestions()
    {
        return $this->hasMany(Question::class);
    }

    // quiz->article = 1..1
    public function getArticle()
    {
        return $this->belongsTo(Article::class);
    }
}
