<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\ball;
use App\models\order;
use App\models\demand;
use Auth;

class ballController extends Controller
{
    public function demandindex()
    {
    	$demand=demand::orderbydesc('id')->paginate(20);
    	return view('ball.demandindex',compact('demand'));
    }
    public function transfer()
    {
    	$order=order::whereNull('onay1')->get();
    	return view('ball.transfer',compact('order'));
    }
    public function demandstore(Request $Request)
    {
    	$Request['users_id']=Auth::id();
    	demand::create($Request->all());
    	return redirect('ball/demandindex')->with('success','Başarılı..');
    }
    public function transferdetail($id)
    {
    	$demand=demand::where('id',$id)->first();
    	$ball=ball::where('order_id',$demand->order_id)->where('oldorder_id',$demand->oldorder_id)->get();
    	return view('ball.transferdetail',compact('demand','ball'));
    }
    public function transferstore(Request $Request)
    {
    	$ball=ball::where('barcode',$Request->barcode)->first();
    	if($ball->order_id==$Request->oldorder_id)
	    	{	$no=ball::where('order_id',$Request->order_id)->max('no');
		    	$barcode=ball::where('order_id',$Request->order_id)->max('barcode');
		    	if($barcode <= 0)
		    	 {$barcode = $Request->order_no.'-01'; $no=1;}
		    	else
		    	{$barcode++; $no++;}
		    	$kkform=$ball->replicate(); 
		    	$kkform->order_id=$Request->order_id;$kkform->oldorder_id=$Request->oldorder_id;$kkform->barcode=$barcode;$kkform->users_id=Auth::id();$kkform->no=$no;
		    	$kkform->save();
		    	$ball->update(['durum_id'=>2]);
		        return view('kkform.firststicker',compact('kkform'));
		    }
	    else return back()->with('error','Hatalı Barcode(Siparişle Uyuşmayan Top!)');	
    }

    public function split()
    {
    	return view('ball.split');
    }

    // public function splitstore(Request $Request)
    // {
    // 	$ball=ball::where('barcode',$Request->barcode)->first();
    // 	return $ball;
    // }
}
