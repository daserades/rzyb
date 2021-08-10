<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table='orders';
    protected $fillable=['order_no','desen_id','varyant','firma_no','picture','firma_id','tesis_id','ordertur_id','desenadi','kalite','siptrh','irsaliyesekli_id','leventgenisligi','cts','tarakeni','tarakno','makinatip','atkisikligi','ortakcozgumetraji','cozgumetraji','hamen','en','boy','ebatcins_id','kenartipi_id','kenarcinsi_id','kalitedetay_id','miktar','munit_id','termin','renk','renk2','const','fiyat','unit_id','kur_id','vade','bazkur','hamsip','mamulsip','duzboyarenkno','gelencozgumetre','odemesekli','orderadres','orderproses','sevkiyat','aciklama1','aciklama2','aciklama3','onay1','numune','dokumaadet','dokumatelsayi','dokumateleni','users_id'];
    public function orderdetailwarp()
    {
        return $this->hasMany(orderdetailwarp::class);
    }
    public function orderdetailweft()
    {
        return $this->hasMany(orderdetailweft::class);
    }
	public function instructions()
    {
        return $this->hasMany('App\models\instructions');
    }
    public function firma ()
    {
    	return $this->belongsTo('App\models\firma','firma_id','id');
    }
    public function tesis ()
    {
        return $this->belongsTo('App\models\tesis','tesis_id','id');
    }
    public function kur ()
    {
    	return $this->belongsTo('App\models\kur','kur_id','id');
    }
    public function ordertur ()
    {
        return $this->belongsTo('App\models\ordertur','ordertur_id','id');
    }
    public function unit ()
    {
        return $this->belongsTo('App\models\unit','munit_id','id');
    }
    public function unit2 ()
    {
        return $this->belongsTo('App\models\unit','unit_id','id');
    }
    public function ebatcins ()
    {
        return $this->belongsTo('App\models\ebatcins','ebatcins_id','id');
    }
    public function kenartipi ()
    {
        return $this->belongsTo('App\models\kenartipi','kenartipi_id','id');
    }
    public function kenarcinsi ()
    {
        return $this->belongsTo('App\models\kenarcinsi','kenarcinsi_id','id');
    }
    public function kalitedetay ()
    {
        return $this->belongsTo('App\models\kalitedetay','kalitedetay_id','id');
    }
    public function desen ()
    {
        return $this->belongsTo('App\models\desen');
    }
    public function irsaliyesekli ()
    {
        return $this->belongsTo('App\models\irsaliyesekli');
    }
     public function orderweft ()
    {
        return $this->hasOne('App\models\orderweft');
    }
     public function orderwarp ()
    {
        return $this->hasOne('App\models\orderwarp');
    }
    public function machineplan ()
    {
        return $this->hasOne('App\models\machineplan');
    }
    public function ball ()
    {
        return $this->hasMany('App\models\ball');
    }
    public function boyahanedetail ()
    {
        return $this->hasMany('App\models\boyahanedetail');
    }
    public function iplikirsaliye ()
    {
        return $this->hasMany('App\models\iplikirsaliye');
    }
    public function leventhareket ()
    {
        return $this->hasMany('App\models\leventhareket');
    }
    public function sevkham_detail ()
    {
        return $this->hasMany(sevkham_detail::class);
    }
    public function user ()
    {
        return $this->belongsTo('App\User','users_id','id');
    }
}