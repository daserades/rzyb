<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class boyahanedetail extends Model
{
    protected $table='boyahanedetails';
    protected $fillable= ['boyahane_id','order_id','metre','kg','aciklama','mamulen','fiyat','kur_id','terbiyesureci_id','users_id'];

    public function boyahane()
    {
    	return $this->belongsTo(boyahane::class);
    }
    public function order()
    {
    	return $this->hasone('App\models\order','id','order_id');
    }
    public function terbiyesureci()
    {
    	return $this->hasone('App\models\terbiyesureci','id','terbiyesureci_id');
    }
    public function kur()
    {
    	return $this->belongsTo(kur::class);
    }
}
