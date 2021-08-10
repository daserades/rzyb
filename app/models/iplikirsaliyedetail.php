<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class iplikirsaliyedetail extends Model
{
     protected  $table='iplikirsaliyedetails';
    protected  $fillable=['barcode','hareketturu_id','sira','iplikirsaliye_id','iplikmarka','iplikcins_id','boyacins_id','iplikno','ne','renk','renkno','renksim','renknosim','partino','miktar','brutmiktar','unit_id','users_id'];


    public function iplikcins()
    {
    	return $this->belongsTo('App\models\iplikcins');
    }
    public function hareketturu()
    {
        return $this->belongsTo('App\models\hareketturu');
    }
    public function iplikirsaliye()
    {
    	return $this->belongsTo('App\models\iplikirsaliye');
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
