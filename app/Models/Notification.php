<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'notifiable_type', 'notifiable_id');

    public function notifiable()
    {
        return $this->morphTo();
    }

}