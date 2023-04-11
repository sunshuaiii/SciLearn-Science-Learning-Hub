<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $hidden = ['user_id'];
    public $timestamps = false;

    // colletion->topic = *..*
    public function getTopics()
    {
        return $this->belongsToMany(Topic::class);
    }

    // colletion->user = *..1
    public function getUser()
    {
        return $this->belongsTo(User::class);
    }
}
