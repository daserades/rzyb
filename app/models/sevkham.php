<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class sevkham extends Model
{
    protected $table='sevkhams';
    protected $fillable = ['firma_id','irsaliyeno','firmatipi_id','trh','adres','aciklama','users_id'];

     public function firma(){
     	return $this->belongsTo('App\models\firma');
     }
     public function firmatipi(){
     	return $this->belongsTo('App\models\firmatipi');
     }
     public function sevkhamdetail(){
     	return $this->hasMany('App\models\sevkham_detail');
     }

}
