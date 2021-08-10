<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class kalitedetay extends Model
{
    protected $table ='kalitedetays';
    protected $fillable = ['name','cozgu_iplik','cozgu_siklik','atki_iplik','atki_siklik','gsm'];
}
