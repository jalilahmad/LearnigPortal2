<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseEpisode extends Model
{
    //
    protected $fillable = [
        'episode_title',
        'episode_description',
        'episode_video',
        'uuid'
    ];
    protected $hidden = ['episode_video'];

    public function course(){

        return $this->belongsTo('App\Course','course_id','id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function watchlist(){

        return $this->belongsToMany('App\User');
    }
}
