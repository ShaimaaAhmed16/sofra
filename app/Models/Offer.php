<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model 
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('name', 'image', 'content','price','start_date', 'end_date','restaurant_id');

    public function restaurant(){
      return $this->belongsTo('App\Models\Restaurant');
    }
}