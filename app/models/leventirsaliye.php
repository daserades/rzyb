<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class leventirsaliye extends Model
{
      protected $table='leventirsaliyes';
    protected $fillable = ['hareketturu_id','firmatipi_id','firma_id','gtrh','ctrh','barcode_adet','irsaliye_no','fatura_no','aciklama','users_id'];
   
     public function hareketturu()
    {
        return $this->belongsTo('App\models\hareketturu');
    }
    public function firma()
    {
        return $this->belongsTo('App\models\firma');
    }
    public function firmatipi()
    {
        return $this->belongsTo('App\models\firmatipi');
    }
    public function leventhareket()
    {
        return $this->hasMany('App\models\leventhareket');
    }
}
