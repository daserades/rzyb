<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class iskarta extends Model
{
    protected $table = 'iskartas';
    protected $fillable=['metre','type','barcode','users_id'];
}
