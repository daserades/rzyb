<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class orderwarp extends Model
{
	 protected $table='orderwarp';
    protected $fillable=['order_id','desenadi',
    'cno1','cne1','crenk1','cgr1','cbg1',
'cno2','cne2','crenk2','cgr2','cbg2',
'cno3','cne3','crenk3','cgr3','cbg3',
'cno4','cne4','crenk4','cgr4','cbg4',
'cno5','cne5','crenk5','cgr5','cbg5',
'cno6','cne6','crenk6','cgr6','cbg6',
'cno7','cne7','crenk7','cgr7','cbg7',
'cno8','cne8','crenk8','cgr8','cbg8',
'cno9','cne9','crenk9','cgr9','cbg9',
'cno10','cne10','crenk10','cgr10','cbg10',
'cno11','cne11','crenk11','cgr11','cbg11',
'cno12','cne12','crenk12','cgr12','cbg12',
'users_id'
];
	public function order ()
    {
    	return $this->belongsTo('App\models\order','order_id','id');
    }
}
