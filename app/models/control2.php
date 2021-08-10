<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class control2 extends Model
{
    protected $table='control2s';
    protected $fillable=['control','no','type','date','year','month','day','hour','minute','second'];
}
