<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class uretimtakip extends Model
{
   protected $table='uretimtakips';
  protected $fillable=['machine_id','order_id','barcode','leventdepo_id','start','end','users_id'];
  
  public function leventdepo()
  {
  	return $this->belongsto(leventdepo::class);
  }
  public function order()
  {
  	return $this->belongsto(order::class);
  }
  public function machine()
  {
    return $this->belongsto(machine::class);
  }
}
