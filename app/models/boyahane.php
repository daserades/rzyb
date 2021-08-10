<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class boyahane extends Model
{
    protected $table='boyahanes';
    protected $fillable= ['no','firma_id','users_id'];

    public function boyahanedetail()
    {
    	return $this->hasMany(boyahanedetail::class);
    }
    public function firma()
    {
    	return $this->belongsTo(firma::class);
    }
}
