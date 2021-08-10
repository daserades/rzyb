<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\instructions;
use App\models\desen;
use App\models\order;
use App\models\patterndetail;
use App\models\patternwarp;
use Auth;
use DB;


class instructionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $order=order::with(['desen','desen.patterndetail'=>function($q){
            $q->orderbydesc('iplikseridi_id');
        },
        'desen.patterndetail.patternwarp'
        ,
        'desen.instructions'
    ])->where('id',$id)->first();
        //return $order;
        return view('instructions.create',compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $alan= $request-> get('alan');
        //$deger = str_replace(",",".",$request->get('deger'));
        $deger = $request->get('deger');
        $patterndetail_id=$request->get('patterndetail_id');
        if (instructions::where('patterndetail_id',$patterndetail_id)->first())
        {
            instructions::where('patterndetail_id',$patterndetail_id)->update([$alan => $deger,'order_id'=>$request->get('order_id'),'sumcozgutel'=>$request->get('tel'),'desen_id'=> $request->get('desen_id'),'netkg'=> $request->get('netkg'),'kazankg'=> $request->get('kazankg'),'mtulgr'=> $request->get('gr')]);
            patterndetail::where('id',$patterndetail_id)->update(['sumtel'=>$request->get('tel')]);
        }
        else
        {  
            instructions::insert(['patterndetail_id'=>$patterndetail_id,$alan=>$deger,'desen_id'=>$request->get('desen_id'),'sumcozgutel'=>$request->get('tel'),'order_id'=>$request->get('order_id'),'users_id'=>Auth::id()]);
            patterndetail::where('id',$patterndetail_id)->update(['sumtel'=>$request->get('tel')]);
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
