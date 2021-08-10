<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class kumasdetail extends Model
{
 	protected $table='kumasdetails';
    protected $fillable= ['kumas_id','order_id','type','metre','mamulen','fiyat','kur_id','users_id'];   

    public function kumas()
    {
    	return $this->belongsTo(kumas::class);
    }
    public function order()
    {
    	return $this->belongsTo(order::class);
    }
    public function kur()
    {
    	return $this->belongsTo(kur::class);
    }
    public function ball()
    {
    	return $this->hasOne(ball::class);
    }
}
