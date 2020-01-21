<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('title', 'address', 'special_order', 'order_time', 'delivery', 'status', 'cost', 'commission', 'net','total', 'payment_method_id', 'client_id', 'restaurant_id' );

    public function payment()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('price','quantity','note');
    }

}