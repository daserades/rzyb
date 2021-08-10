<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class sevkmamul extends Model
{
    protected $table='sevkmamuls';
    protected $fillable = ['firma_id','irsaliyeno','firmatipi_id','trh','adres','aciklama','users_id'];

     public function firma(){
     	return $this->belongsTo('App\models\firma');
     }
     public function firmatipi(){
     	return $this->belongsTo('App\models\firmatipi');
     }
     public function sevkmamuldetail(){
     	return $this->hasMany('App\models\sevkmamul_detail');
     }

}
