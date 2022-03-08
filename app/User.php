<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Permissions\HasPermissionsTrait;

class User extends Authenticatable
{
    use HasPermissionsTrait; //Import The Trait
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','first_name','last_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Courses(){
        
        return $this->hasMany('App\Course');

    }
    public function watchlist(){

        return $this->belongsToMany('App\CourseEpisode','watchlists', 'user_id', 'episode_id');
    }

    public function bookmark(){

        return $this->belongsToMany('App\Course','bookmarks', 'user_id', 'course_id');
    }


}
