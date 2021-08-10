<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ball extends Model
{
    protected $table= 'balls';
    protected $fillable= ['uretimtakip_id','kumas_id','kumasdetail_id','kkform_id','barcode','type','no','order_id','leventdepo_id','levent_barcode','machine_id','metre','brutmetre','kumaseni','kg','ebat','hamboy','trh','durum_id','oldorder_id','ordertur_id','users_id'];

    public function kkform()
  {
    return $this->belongsto(kkform::class);
  }
    public function machine()
  {
    return $this->belongsto(machine::class);
  }
  public function uretimtakip()
  {
    return $this->belongsto(uretimtakip::class);
  }
  public function order()
  {
    return $this->belongsto(order::class);
  }
  public function leventdepo()
  {
    return $this->belongsto(leventdepo::class);
  }
  public function durum()
  {
    return $this->belongsto(durum::class);
  }
  public function kumasdetail()
  {
    return $this->hasone('App\models\kumasdetail','id','kumasdetail_id');
  }

}
