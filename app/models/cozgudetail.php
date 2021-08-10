<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class cozgudetail extends Model
{
    protected $table='cozgudetails';
    protected $fillable=['cozgu_id','hareketturu_id','iplikirsaliye_id','iplikirsaliyedetail_id','sira','barcode','iplikmarka','iplikcins_id','boyacins_id','iplikno','ne','renk','renkno','renksim','renknosim','partino','miktar','brutmiktar','unit_id','users_id'];
}
