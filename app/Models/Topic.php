<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    public $timestamps = false;

    // topic->colletion = *..*
    public function getCollections()
    {
        return $this->belongsToMany(User::class);
    }

    // topic->module = *..1
    public function getModule()
    {
        return $this->belongsTo(Module::class);
    }

    // topic->article = 1..*
    public function getArticles()
    {
        return $this->hasMany(Article::class);
    }
}
