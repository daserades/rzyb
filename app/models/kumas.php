<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class kumas extends Model
{
    protected $table='kumas';
    protected $fillable= ['firma_id','adet','irsaliye_no','fatura_no','users_id'];

    public function firma()
    {
    	return $this->belongsTo(firma::class);
    }
    public function kumasdetail()
    {
    	return $this->hasMany(kumasdetail::class);
    }
}
