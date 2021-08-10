<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class firma extends Model
{
    protected $table='firmas';
    protected $fillable=['zarano','name','firmatipi_id','unvan','vergidairesi','verginumarasi','tel1','tel2','fax1','fax2','email1','email2','adres1','adres2','countries_id','cities_id','banka','sube','hesapno','iban','website','durums_id','yesno_id','aciklama','users_id'];

    public function country ()
    {
    	return $this->belongsTo('App\models\country','countries_id','id');
    } 
    public function city ()
    {
    	return $this->belongsTo('App\models\city','cities_id','id');
    }
     public function firmatipi ()
    {
    	return $this->belongsTo('App\models\firmatipi','firmatipi_id','id');
    }
     public function durum ()
    {
    	return $this->belongsTo('App\models\durum','durums_id','id');
    }
     public function yesno ()
    {
    	return $this->belongsTo('App\models\yesno','yesno_id','id');
    }
}
