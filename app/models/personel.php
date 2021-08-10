<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class personel extends Model
{
    protected $table='personels';
    protected $fillable =['name','surname','tel','departman_tb_id','gorevlistesis_tb_id','gtrh','ctrh','durums_tb_id','users_tb_id','adres','no'];

	public function user()
	{
		return $this->belongsTo('App\User','users_tb_id','id');
	}
    public function durum()
	{
		return $this->belongsTo('App\models\durum','durums_tb_id','id');
	}
	public function departman()
	{
		return $this->belongsTo('App\departman','departman_tb_id','id');
	}
	public function gorevlistesi()
	{
		return $this->belongsTo('App\models\gorevlistesi','gorevlistesis_tb_id','id');
	}
}
