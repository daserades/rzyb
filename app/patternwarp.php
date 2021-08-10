<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patternwarp extends Model
{
    protected $table = 'patternwarp';
    protected $fillable= ['desen_id','iplikseridi_id','patterndetail_id','type','iplikno','iplikkalin','iplikcins_id','boyacins_id','renk_no','renk','harf','sayi','atki_sikligi','cozgu_sikligi','tekrar','bos_atki_sayisi','ayni_agiza_atilan_atki_sayisi','users_id'];
      public function patterndetail ()
    {
    	return $this->belongsTo('App\models\patterndetail');
    }
    public function desen ()
    {
    	return $this->belongsTo('App\models\desen');
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
}
