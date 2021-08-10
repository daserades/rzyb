<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class kkform extends Model
{
    protected $table='kkforms';
    protected $fillable=['order_id','barcode','metre','brutmetre','kumaseni','machine_id','ebat','trh','kg','hamboy','aciklama','users_id'];

    public function order() {
    	return $this->belongsTo('App\models\order');
    }
    public function machine() {
    	return $this->belongsTo(machine::class);
    }
     public function sevkham_detail() {
    	return $this->hasOne('App\models\sevkham_detail');
    }
    public function kkformdetail()
    {
    	return $this->hasMany(kkformdetail::class);
    }
    public function ball()
    {
        return $this->hasMany(ball::class);
    }
}
