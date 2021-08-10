<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class orderdetailwarp extends Model
{
    protected $table='orderdetailwarps';
    protected $fillable=['order_id','desen_id','sira','cinsne','crenkno','crenk','boyanankg','gelenkg','users_id'];
}
