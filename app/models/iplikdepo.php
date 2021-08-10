<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class iplikdepo extends Model
{
    protected  $table='iplikdepos';
    protected  $fillable=['iplikirsaliye_id','iplikirsaliyedetail_id','sira','barcode','order_id','iplikmarka','iplikcins_id','boyacins_id','firma_id','iplikno','ne','renk','renkno','renksim','renknosim','partino','miktar','brutmiktar','unit_id','fiyat','kur_id','irsaliye_no','fatura_no','aciklama','users_id'];


    public function iplikbukumdetail()
    {
        return $this->hasOne(iplikbukumdetail::class);
    }
    public function iplikirsaliye()
    {
        return $this->belongsTo('App\models\iplikirsaliye');
    }
    public function order()
    {
        return $this->belongsTo('App\models\order');
    }
    public function iplikcins()
    {
    	return $this->belongsTo('App\models\iplikcins');
    }
    public function firma()
    {
    	return $this->belongsTo('App\models\firma');
    }
    public function boyacins()
    {
    	return $this->belongsTo('App\models\boyacins');
    } 
    public function unit()
    {
    	return $this->belongsTo('App\models\unit');
    } 
    public function kur()
    {
    	return $this->belongsTo('App\models\kur');
    } 
}
