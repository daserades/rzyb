<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class iplikbukum extends Model
{
     protected  $table='iplikbukums';
    protected  $fillable=['no','name','order_id','firma_id','aciklama','users_id'];


    public function order()
    {
    	return $this->belongsTo('App\models\order');
    }
    public function firma()
    {
    	return $this->belongsTo('App\models\firma');
    }
    public function iplikbukumdetail()
    {
    	return $this->hasMany(iplikbukumdetail::class);
    }
      public function iplikirsaliye()
    {
    	return $this->hasone(iplikirsaliye::class);
    }

}
