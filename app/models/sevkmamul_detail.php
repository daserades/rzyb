<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class sevkmamul_detail extends Model
{
    protected $table='sevkmamul_details';
    protected $fillable=['sevkmamul_id','mamulkkform_id','order_id','barkod','top_id','metre','users_id'];
    public function order() {
    	return $this->belongsTo('App\models\order');
    }
    public function mamulkkform() {
    	return $this->hasOne('App\models\mamulkkform');
    }
    public function sevkmamul() {
    	return $this->belongsTo('App\models\sevkmamul');
    }
}
