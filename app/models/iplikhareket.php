<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class iplikhareket extends Model
{
    protected $table='iplikharekets';
    protected $fillable = ['hareketturu_id','firmatipi_id','barcode','order_id','iplikdepo_id','firma_id','gtrh','ctrh','iplikmarka','iplikcins_id','boyacins_id','iplikno','ne','renk','renkno','partino','miktar','brutmiktar','unit_id','fiyat','kur_id','irsaliye_no','fatura_no','aciklama','users_id'];
    public function iplikdepo()
    {
    	return $this->hasMany('App\models\iplikdepo');
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
    public function iplikcins()
    {
    	return $this->belongsTo('App\models\iplikcins');
    } 
    public function unit()
    {
    	return $this->belongsTo('App\models\unit');
    } 
    public function kur()
    {
    	return $this->belongsTo('App\models\kur');
    } 
    public function boyacins()
    {
    	return $this->belongsTo('App\models\boyacins');
    }
    public function firmatipi()
    {
    	return $this->belongsTo('App\models\firmatipi');
    }
}
