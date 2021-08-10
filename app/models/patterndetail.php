<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class patterndetail extends Model
{
    protected $table='patterndetail';
    protected $fillable = ['desen_id','iplikseridi_id','sumtel','iplik_no','iplik_kalin','iplikcins_id','boyacins_id','renk_no','renk','renk_sayisi','harf','sayi','atki_sikligi','cozgu_sikligi','tekrar','bos_atki_sayisi','ayni_agiza_atilan_atki_sayisi','aciklama','users_id'];

     public function desen ()
    {
    	return $this->belongsTo('App\models\desen','desen_id','id');
    } 
    public function iplikseridi ()
    {
    	return $this->belongsTo('App\models\iplikseridi','iplikseridi_id','id');
    } 
    public function iplikcins ()
    {
        return $this->belongsTo('App\models\iplikcins','iplikcins_id','id');
    }
    public function boyacins ()
    {
        return $this->belongsTo('App\models\boyacins');
    } 
    public function patternwarp ()
    {
        return $this->hasMany('App\patternwarp');
    } 
    
    public function instructions ()
    {
        return $this->hasOne('App\models\instructions');
    }
}