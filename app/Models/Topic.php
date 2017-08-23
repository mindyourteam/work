<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['title'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'topic_user', 'topic_id', 'user_id')
            ->withPivot('hidden')
            ->withTimestamps();
    }
}
