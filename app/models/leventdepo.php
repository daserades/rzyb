<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class leventdepo extends Model
{
    protected $table='leventdepos';
    protected $fillable=['order_id','barcode','leventirsaliye_id','leventhareket_id','no','cozgu_id','telsayi','leventno','leventeni','metraj','kg','stok','durum_id','users_id'];
    public function order ()
    {
        return $this->belongsTo('App\models\order');
    }
    public function cozgu ()
    {
        return $this->belongsTo('App\models\cozgu');
    }
    public function leventhareket ()
    {
        return $this->belongsTo('App\models\leventhareket');
    }
    public function ball ()
    {
        return $this->hasMany('App\models\ball');
    }
    public function durum ()
    {
        return $this->belongsTo(durum::class);
    }
}