<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;
    public $timestamps = false;

    // badge->user = *..*
    public function getUsers()
    {
        return $this->belongsToMany(User::class, 'userbadges');
    }
}
