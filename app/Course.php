<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Course extends Model implements Searchable
{
    //
    
    protected $table = 'courses';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_title', 'course_intro',
    ];

    public function user(){

        return $this->belongsTo('App\User','user_id','id');
    }

    public function tags(){

        return $this->belongsToMany('App\Tag');
    }
    
    public function courseEpisodes(){
         
        return $this->hasMany('App\CourseEpisode');
    }

    public function getSearchResult(): SearchResult
    {
       $url = route('course.show', $this->id);
    
        return new \Spatie\Searchable\SearchResult(
           $this,
           $this->course_title,
           $url
        );
    }

  

}
