<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class orderweft extends Model
{
      protected $table='orderweft';
    protected $fillable=['order_id','desenadi',
    
	'ano1','ane1','arenk1','agr1','asik1','abg1',
	
	'ano2','ane2','arenk2','agr2','asik2','abg2',
	
	'ano3','ane3','arenk3','agr3','asik3','abg3',
	
	'ano4','ane4','arenk4','agr4','asik4','abg4',
	
	'ano5','ane5','arenk5','agr5','asik5','abg5',
	
	'ano6','ane6','arenk6','agr6','asik6','abg6',
	
	'ano7','ane7','arenk7','agr7','asik7','abg7',
	
	'ano8','ane8','arenk8','agr8','asik8','abg8',
	
	'ano9','ane9','arenk9','agr9','asik9','abg9',
	
	'ano10','ane10','arenk10','agr10','asik10','abg10',
	
	'ano11','ane11','arenk11','agr11','asik11','abg11',
	
	'ano12','ane12','arenk12','agr12','asik12', 'abg12',
	'users_id'
	];
	public function order ()
    {
    	return $this->hasOne('App\models\order');
    }
}
