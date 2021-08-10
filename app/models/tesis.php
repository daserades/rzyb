<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class tesis extends Model
{
    protected $table='tesis';
    protected $fillable=['name','firmas_id','firmatipi_id','unvan','vergidairesi','verginumarasi','tel1','tel2','fax1','fax2','email1','email2','adres1','adres2','banka','sube','hesapno','iban','website','durums_id','aciklama','users_id'];

    public function firma ()
    {
    	return $this->belongsTo('App\models\firma','firmas_id','id');
    }
     public function firmatipi ()
    {
    	return $this->belongsTo('App\models\firmatipi','firmatipi_id','id');
    }
     public function durum ()
    {
    	return $this->belongsTo('App\models\durum','durums_id','id');
    }

}
