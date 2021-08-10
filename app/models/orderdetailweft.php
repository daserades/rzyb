<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class orderdetailweft extends Model
{
     protected $table='orderdetailwefts';
    protected $fillable=['order_id','desen_id','sira','acinsne','arenkno','arenk','aboyanankg','agelenkg','asiklik','users_id'];
}
