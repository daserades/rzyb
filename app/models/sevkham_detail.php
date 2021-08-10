<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class sevkham_detail extends Model
{
    protected $table='sevkham_details';
    protected $fillable=['sevkham_id','kkform_id','ball_id','boyahane_id','order_id','barcode','top_id','metre','users_id'];
    
    public function order() {
    	return $this->belongsTo('App\models\order');
    }
    public function kkform() {
    	return $this->hasOne('App\models\kkform');
    }
    public function sevkham() {
    	return $this->belongsTo('App\models\sevkham');
    }
}


