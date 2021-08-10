<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class onay extends Model
{
    protected $table ='onays';
    protected $fillable = ['sipdurum_id','table','table_id','users_id'];

    public function sipdurum () 
    {
    	return $this->belongsTo('App\models\sipdurum');
    }
}
