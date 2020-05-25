<?php

namespace Mindyourteam\Work\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['title', 'count'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'topic_user', 'topic_id', 'user_id')
            ->withPivot('hidden')
            ->withTimestamps();
    }
}
