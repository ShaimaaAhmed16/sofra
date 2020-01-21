<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'tokens';
    public $timestamps = true;
    protected $fillable = array('accountable_type', 'accountable_id', 'token', 'type');
//    public function client(){
//        return $this->belongsTo('App\Models\Client');
//    }accountable_type	accountable_id	token	type
    public function accountable()
    {
        return $this->morphTo();
    }

}
