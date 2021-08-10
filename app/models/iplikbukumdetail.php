<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class iplikbukumdetail extends Model
{
    protected $table= 'iplikbukumdetails';
    protected $fillable= ['iplikbukum_id','iplikdepo_id','iplikirsaliyedetail_id','katsayi','tur','yon','miktar','maxmiktar','aciklama','iplikno','ne','iplikcins_id','renkno','renknosim','users_id'];

    public function iplikbukum()
    {
    	return $this->belongsTo(iplikbukum::class);
    }
    public function iplikdepo()
    {
    	return $this->hasOne('App\models\iplikdepo','id','iplikdepo_id');
    }
     public function iplikirsaliyedetail()
    {
        return $this->hasOne('App\models\iplikirsaliyedetail','id','iplikirsaliyedetail_id');
    }

}
