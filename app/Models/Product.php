<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('name', 'image', 'content', 'price', 'price_offer','processing_time','restaurant_id','category_id');

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
//    public function reviews()
//    {
//        return $this->hasMany('App\Models\Review');
//    }
//
//    public function getStarRating(){
//        $sum=$this->reviews()->sum('rate');
//        $average=$sum/$this->reviews()->count();
//        return $average;
//    }

}