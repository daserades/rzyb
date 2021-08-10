<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class isemri extends Model
{
    protected $table='isemris';
    protected $fillable = ['no','desen_id','leventadet','parca_sayisi','cozgu_metre','sip_fazlasi','aciklama','users_id'];
    public function desen()
    {
    	return $this->belongsTo('App\models\desen');
    }
	
     public function uretimtakip () {
    	return $this->belongsTo('App\models\uretimtakip','id','isemri_id');
    }    
}
