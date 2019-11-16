<?php 

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{

    public function getPermissionsListAttribute()
    {
        return $this->permissions()->pluck('id')->toArray();
    }

   
    protected $fillable=['name', 'display_name', 'description'];


    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }
    

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

}
