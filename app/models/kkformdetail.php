<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class kkformdetail extends Model
{
    protected $table= 'kkformdetails';
    protected $fillable= ['kkform_id','type','no','metre','hatalist_id','hatapuan_id','vardiya1_id','vardiya2_id','aciklama','users_id'];


	public function kkform()
    {
    	return $this->belongsTo(kkform::class);
    }
    public function hatalist()
    {
    	return $this->belongsTo(hatalist::class);
    }
    public function hatapuan()
    {
    	return $this->belongsTo(hatapuan::class);
    }
    public function vardiya1()
    {
    	return $this->belongsTo('App\models\vardiya','vardiya1_id','id');
    }
    public function vardiya2()
    {
    	return $this->belongsTo('App\models\vardiya','vardiya2_id','id');
    }

}
