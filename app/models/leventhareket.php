<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class leventhareket extends Model
{
    protected $table='leventharekets';
    protected $fillable=['order_id','barcode','leventirsaliye_id','hareketturu_id','no','cozgu_id','telsayi','leventno','leventeni','metraj','kg','fiyat','kur_id','stok','aciklama','users_id'];
    public function cozgu()
    {
        return $this->belongsTo('App\models\cozgu');
    }
    public function order()
    {
        return $this->belongsTo('App\models\order');
    }
    public function kur()
    {
        return $this->belongsTo('App\models\kur');
    }
    public function machine()
    {
        return $this->belongsTo('App\models\machine');
    }
    
}
