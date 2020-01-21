<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model 
{

    protected $table = 'reviews';
    public $timestamps = true;
    protected $fillable = array('comment', 'rate', 'restaurant_id','client_id');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}