<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class instructions extends Model
{
    protected $table='instructions';
	protected $fillable=['desen_id','order_id','patterndetail_id','sumcozgutel','cozgumetraji','cozguhasilfire','iplikboyafire','netkg','kazankg','mtulgr','users_id'];

	 public function order()
	{
		return $this->belongsTo('App\models\order');
	}
	public function desen()
	{
		return $this->belongsTo('App\models\desen');
	}
	public function patterndetail()
	{
		return $this->belongsTo('App\models\patterndetail');
	}
}
