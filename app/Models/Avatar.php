<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;
    public $timestamps = false;

    // avatar->user = 1..*
    public function getUsers()
    {
        return $this->hasMany(User::class);
    }
}
