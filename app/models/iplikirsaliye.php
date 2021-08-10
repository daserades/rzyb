<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class iplikirsaliye extends Model
{
     protected $table='iplikirsaliyes';
    protected $fillable = ['hareketturu_id','firmatipi_id','iplikbukum_id','iplikboya_id','order_id','firma_id','gtrh','ctrh','barcode_adet','fiyat','kur_id','cozgu_id','irsaliye_no','fatura_no','aciklama','users_id'];
    
     public function iplikirsaliyedetail()
    {
        return $this->hasMany('App\models\iplikirsaliyedetail');
    }
     public function hareketturu()
    {
    	return $this->belongsTo('App\models\hareketturu');
    }
    public function firma()
    {
        return $this->belongsTo('App\models\firma');
    } 
    public function order()
    {
    	return $this->belongsTo('App\models\order');
    } 
    public function kur()
    {
    	return $this->belongsTo('App\models\kur');
    } 
    
    public function firmatipi()
    {
    	return $this->belongsTo('App\models\firmatipi');
    }
}
