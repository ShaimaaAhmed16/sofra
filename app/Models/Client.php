<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'password', 'image', 'region_id' ,'pin_code','is_active');

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function tokens()
    {
        return $this->morphMany('App\Models\Token', 'accountable');
    }
//    public function tokens(){
//        return $this->hasMany('App\Models\Token');
//    }
    protected $hidden = [
        'password', 'api_token',
    ];
}