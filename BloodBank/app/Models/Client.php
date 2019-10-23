<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class Client extends Authenticatable 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('phone', 'email', 'name', 'password', 'date_of_birth','blood_type_id', 'last_donation_date', 'city_id', 'pin_code', 'api_token', 'activation');
    protected $hidden = array('password','api_token' , 'pin_code');

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function bloodTypes()
    {
        return $this->belongsToMany('App\Models\BloodType');
    }

    public function cities()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function governorates()
    {
        return $this->belongsToMany('App\Models\Governorate');
    }

    public function donation_requests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }

}