<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommentUser;
class Comment extends Model
{
    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function mentioned_users()
    {
        return $this->hasMany(CommentUser::class, 'comment_id', 'id');
    }
}
