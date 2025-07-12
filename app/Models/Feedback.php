<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FeedCategory;

class Feedback extends Model
{
    public function feedback_category()
    {
        return $this->belongsTo(FeedbackCategory::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   

}
