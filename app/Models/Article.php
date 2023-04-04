<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function getPerson()
    {
        //one to one
        // return $this->hasOne(User::class);

        // one to many
        return $this->hasMany(User::class);

        // many to many
        // return $this->belongsToMany(User::class);
    }
}
