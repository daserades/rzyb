<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class demand extends Model
{
    protected $table='demands';
    protected $fillable=['oldorder_id','order_id','aciklama','users_id'];

    public function oldorder()
    {
    	return $this->belongsTo('App\models\order','oldorder_id','id');
    }
    public function order()
    {
    	return $this->belongsTo('App\models\order','order_id','id');
    }
}
