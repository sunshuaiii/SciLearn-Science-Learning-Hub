<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    public $timestamps = false;

    // module->topic = 1..*
    public function getTopics()
    {
        return $this->hasMany(Topic::class);
    }
}
