<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class iplikboyadetail extends Model
{
    protected $table= 'iplikboyadetails';
protected $fillable= ['iplikboya_id','iplikseridi_id','orderdetail_id','miktar','fiyat','kur_id','aciklama','users_id'];

    public function order()
    {
        return $this->belongsTo('App\models\order');
    }
    public function iplikboya()
    {
        return $this->belongsTo('App\models\iplikboya');
    }
    public function iplikseridi()
    {
        return $this->belongsTo('App\models\iplikseridi');
    }
    public function kur()
    {
        return $this->belongsTo('App\models\kur');
    }
    public function orderdetailwarp()
    {
        return $this->belongsTo(orderdetailwarp::class,'orderdetail_id');
    }
    public function orderdetailweft()
    {
        return $this->belongsTo(orderdetailweft::class,'orderdetail_id');
    }
}
