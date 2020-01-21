<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class Restaurant extends Authenticatable
{

    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'password', 'image', 'state', 'minimum', 'delivery_charge', 'whats', 'region_id',
        'pin_code','opened_at','closed_at','rating');
    protected $appends = ['is_open','star_rating'];
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function region()
    {
        return $this->belongsTo('App\Models\Region','region_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function offers(){
        return $this->hasMany('App\Models\Offer');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }

    protected $hidden = [
        'password', 'api_token',
    ];
    public function getIsOpenAttribute(){
        return Carbon::now()->between(
            Carbon::parse($this->opened_at),
            Carbon::parse($this->closed_at)
        );
    }
    public function getStarRatingAttribute(){
        $rate=$this->reviews()->avg('rate');
        return $rate;
    }

    public function tokens()
    {
        return $this->morphMany('App\Models\Token', 'accountable');
    }

}