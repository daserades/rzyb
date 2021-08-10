<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class bukumdepo extends Model
{
    protected  $table='bukumdepos';
    protected  $fillable=['stokhareket_id','order_id','iplikcins_id','boyacins_id','iplikdepo_id','bukumdepo','bukumsekli','iplikno','ne','renk','renkno','partino','miktar','brutmiktar','unit_id','fiyat','kur_id','irsaliye_no','fatura_no','iademiktar','aciklama','users_id'];

    public function order()
    {
        return $this->belongsTo('App\models\order');
    }
    public function iplikcins()
    {
    	return $this->belongsTo('App\models\iplikcins');
    }
    public function iplikdepo()
    {
        return $this->belongsTo('App\models\iplikdepo');
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
