<?php

namespace App\Models;

use App\Models\Collection;
use App\Models\Topic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionTopic extends Model
{
    use HasFactory;
    protected $hidden= ['user_id', 'topic_id'];
    public $timestamps = false;


    public function getCollections()
    {
        return $this->hasMany(Collection::class);
    }

    public function getTopics()
    {
        return $this->hasMany(Topic::class);
    }
}
