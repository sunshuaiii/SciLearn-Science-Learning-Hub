<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    // public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'is_admin',
        'avatar_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // user->quiz = *..*
    public function getQuizzes()
    {
        return $this->belongsToMany(Quiz::class, 'user_quizzes');
    }

    // user->leaderboard = 1..1
    public function getLeaderboard()
    {
        return $this->hasOne(Leaderboard::class);
    }

    // user->avatar = *..1
    public function getAvatar()
    {
        return $this->belongsTo(Avatar::class);
    }

    // user->collection = 1..*
    public function getCollections()
    {
        return $this->hasMany(Collection::class);
    }
}
