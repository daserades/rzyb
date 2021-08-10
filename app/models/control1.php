<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class control1 extends Model
{
    protected $table='control1s';
    protected $fillable=['control','no','type','date','year','month','day','hour','minute','second'];
}
