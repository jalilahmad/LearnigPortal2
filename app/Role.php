<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //relationship with users and permissions
    public function permissions() {

        return $this->belongsToMany(Permission::class,'roles_permissions');
            
     }
     
     public function users() {
     
        return $this->belongsToMany(User::class,'users_roles');
        
     }
            
}
