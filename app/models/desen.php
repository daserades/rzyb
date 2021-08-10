<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class desen extends Model
{
     protected $table = 'desens';
    protected $fillable  = ['name','varyant','order_no','no','atki_sikligi','picture','cozgu_sikligi','cts','tarak_eni','faydali_tarak_eni','tarak','tarak_no','ham_en','ham_boy','ham_gr','mamul_en','mamul_boy','mamul_gr','armur','tahar','kenargenisligi','aciklama'];
    public function order () 
    {
    	return $this->hasMany('App\models\order','order_no','id');
    }
    public function patternwarp () 
    {
        return $this->hasMany('App\patternwarp');
    }
    public function patterndetail () 
    {
    	return $this->hasMany('App\models\patterndetail');
    }
    public function isemri()
    {
        return $this->belongsTo('App\models\isemri','id','desen_id');
    }
    
    public function instructions () 
    {
        return $this->hasMany('App\models\instructions');
    }
        public function orderdetailwarp()
    {
        return $this->hasMany(orderdetailwarp::class);
    }
    public function orderdetailweft()
    {
        return $this->hasMany(orderdetailweft::class);
    }

}
