<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class machineplan extends Model
{
    protected $table='machineplans';
  	protected $fillable=['order_id','machine_id','leventdepo_id','users_id'];
  
	public function machine ()
    {
        return $this->belongsTo('App\models\machine');
    }  
}
