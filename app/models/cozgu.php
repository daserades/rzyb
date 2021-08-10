<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class cozgu extends Model
{
      protected  $table='cozgus';
    protected  $fillable=['no','order_id','firma_id','telsayi','leventeni','metraj','bobinadet','tip','aciklama','users_id'];


    public function order()
    {
    	return $this->belongsTo('App\models\order');
    }
    public function firma()
    {
    	return $this->belongsTo('App\models\firma');
    }
      public function cozgudetail()
    {
        return $this->hasMany('App\models\cozgudetail');
    } 

}
