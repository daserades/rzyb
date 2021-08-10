<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class mamulkkform extends Model
{
    protected $table='mamulkkforms';
    protected $fillable=['order_id','topno','metre','brutmetre','kumaseni','makina','kg','ebat','trh','aciklama','users_id'];

    public function order() {
    	return $this->belongsTo('App\models\order');
    }
}
