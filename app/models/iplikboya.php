<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class iplikboya extends Model
{
     protected  $table='iplikboyas';
    protected  $fillable=['no','firma_id','order_id','aciklama','users_id'];

    public function firma()
    {
    	return $this->belongsTo('App\models\firma');
    }
    public function iplikboyadetail()
    {
    	return $this->hasMany('App\models\iplikboyadetail');
    }
    public function order()
    {
        return $this->belongsTo('App\models\order');
    }
      public function iplikirsaliye()
    {
    	return $this->hasone(iplikirsaliye::class);
    }
}
