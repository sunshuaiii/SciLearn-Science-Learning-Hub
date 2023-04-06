<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    use HasFactory;

    // leaderboard->user = 1..1
    public function getUser()
    {
        return $this->belongsTo(User::class);
    }
}
