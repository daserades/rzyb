<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\sevkmamul;
use Yajra\Datatables\Datatables;
use App\models\sevkmamul_detail;
use App\models\firma;
use App\models\mamulkkform;
use App\models\firmatipi;
use Auth;
use DB;
class sevkmamulcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sevkmamul.index');
    }
    
    public function create()
    {
        $firma=firma::get();
        $firmatipi=firmatipi::get();
        return view('sevkmamul.create',compact('firma','firmatipi'));
    }
    public function fdetay($id)
    {
        $firma= firma::where('id',$id)->select('adres1')->get();
        return $firma;
    }


    public function store(Request $request)
    {
         $sevkmamul = new sevkmamul ([
            'firma_id'=>$request->get('firma_id'),
            'firmatipi_id'=>$request->get('firmatipi_id'),
            'trh'=>$request->get('trh'),
            'irsaliyeno'=>$request->get('irsaliyeno'),
            'adres'=>$request->get('adres'),
            'aciklama'=>$request->get('aciklama'),
            'users_id'=>Auth::id()
        ]);
        $sevkmamul->save();
         if($request->firmatipi_id == 1 )
         {

          $mamulkkform= mamulkkform::join('orders','orders.id','=','mamulkkforms.order_id')
                        ->leftjoin('sevkmamul_details','sevkmamul_details.mamulkkform_id','=','mamulkkforms.id')
                        ->where('orders.firma_id',$sevkmamul['firma_id'])
                        ->whereNUll('sevkmamul_details.id')
                        ->select('mamulkkforms.id','orders.order_no','topno','mamulkkforms.brutmetre','mamulkkforms.aciklama')
                        ->get();
         }
         else{
            $mamulkkform= mamulkkform::join('orders','orders.id','=','mamulkkforms.order_id')
                        ->select('mamulkkforms.id','orders.order_no','topno','mamulkkforms.brutmetre','mamulkkforms.aciklama')
                          ->orderBydesc('kkforms.id')
                        ->get();
         }
        return view('sevkmamul.mamuldetay',compact('sevkmamul','mamulkkform'));
    }
     public function store2 (Request $request)
    {
        $mamulkkformlist= mamulkkform::where('id',$request->get('mamulkkform_id'))->first();
        $sevkmamuldetail = new sevkmamul_detail ([
            'sevkmamul_id'=>$request->get('sevkmamul_id'),
            'mamulkkform_id'=>$request->get('mamulkkform_id'),
            'order_id'=>$mamulkkformlist['order_id'],
            'top_id'=>$mamulkkformlist['topno'],
            'metre'=>$mamulkkformlist['metre'],
            'users_id'=>Auth::id()
        ]);
        $sevkmamuldetail->save();
        $sevkmamul=sevkmamul::find($request->get('sevkmamul_id'));
        $sevkmamuldetail=sevkmamul_detail::where('sevkmamul_id',$request->get('sevkmamul_id'))->get();
        $mamulkkform= mamulkkform::join('orders','orders.id','=','mamulkkforms.order_id')
                        ->leftjoin('sevkmamul_details','sevkmamul_details.mamulkkform_id','=','mamulkkforms.id')
                        ->where('orders.firma_id',$sevkmamul['firma_id'])
                        ->whereNUll('sevkmamul_details.id')
                        ->select('mamulkkforms.id','orders.order_no','topno','mamulkkforms.brutmetre','mamulkkforms.aciklama')
                        ->get();
        return view('sevkmamul.mamuldetay',compact('sevkmamuldetail','sevkmamul','mamulkkform'));
    }
    public function sevkdetay($id)
    {
        $sevkmamul = sevkmamul::find($id);
        $sevkmamuldetail=sevkmamul_detail::where('sevkmamul_id',$id)->get();
        $mamulkkform= mamulkkform::join('orders','orders.id','=','mamulkkforms.order_id')
                        ->leftjoin('sevkmamul_details','sevkmamul_details.mamulkkform_id','=','mamulkkforms.id')
                        ->where('orders.firma_id',$sevkmamul['firma_id'])
                        ->whereNUll('sevkmamul_details.id')
                        ->select('mamulkkforms.id','orders.order_no','topno','mamulkkforms.brutmetre','mamulkkforms.aciklama')
                        ->get();
        return view('sevkmamul.mamuldetay',compact('sevkmamul','sevkmamuldetail','mamulkkform'));   
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
     $sevkmamul=sevkmamul::find($id);
        $firma=firma::get();
        $firmatipi=firmatipi::get();
        return view('sevkmamul.edit',compact('sevkmamul','firma','firmatipi'));

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
          $sevkmamul = sevkmamul::find($id);
        $sevkmamul ->firma_id = $request->get('firma_id');
        $sevkmamul ->firmatipi_id= $request->get('firmatipi_id');
        $sevkmamul ->trh= $request->get('trh');
        $sevkmamul ->irsaliyeno= $request->get('irsaliyeno');
        $sevkmamul ->adres= $request->get('adres');
        $sevkmamul ->aciklama= $request->get('aciklama');
        $sevkmamul ->users_id= Auth::id();
        $sevkmamul -> save();
        return redirect('/sevkmamul/sevkmamul')->with('success','Sevkiyat Güncellendi');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $sevkmamul = sevkmamul::find($id);
        $sevkmamul -> delete();
        return back()->with('success','Silindi');
    }
     public function destroy2($id)
    {
        $sevkmamuldetail=sevkmamul_detail::find($id);
        $sevkmamuldetail->delete();
        return redirect('sevkmamul/sevkmamuldetay/'.$sevkmamuldetail['sevkmamul_id']);
    }
      public function js ()
    {   
        $sevkmamul= sevkmamul::with('firma','firmatipi')->orderBy('id','DESC')->get();
        return Datatables::of($sevkmamul)
          ->addColumn('action', function ($sevkmamul) {
                $a ='<table><tr>';
                 $a .='<td><a href="report/'.$sevkmamul->id.'" style="color:black" target="blank" title="Sevk Detay"><i class="fas fa-desktop fa-2x"></i></a></td>';
                if(!auth()->user()->hasRole('konfeksiyon plan')) $a .='<td><a href="sevkmamuldetay/'.$sevkmamul->id.'" style="color:black" target="blank" title="Sevkiyat"><i class="fas fa-truck-loading fa-2x"></i></a></td>';
                if(!auth()->user()->hasRole('konfeksiyon plan')) $a .=' <td><a href="sevkmamul/'.$sevkmamul->id.'/edit" style="color:black" target="blank" title="Düzenle"><i class="far fa-edit fa-2x"></i></a></td>';
               if(!auth()->user()->hasRole('konfeksiyon plan')) $a .=' <td><div class="delete-form">
                    <form action="sevkmamul/'.$sevkmamul->id.'" method="POST">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                     <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm("Silmek İstediğinize Emin Misiniz?")"><i class="far fa-trash-alt"></i></button>
                    </form>
                 </div></td>';
             if(!auth()->user()->hasRole('konfeksiyon plan')) $a .='</tr></table>';
                return $a; 
            })
            ->removeColumn('password')
            ->make(true);     
    }
    public function report($id)
    {
        $sevkmamul= sevkmamul::where('id',$id)->first();
        $sevkmamuldetail= sevkmamul_detail::where('sevkmamul_id',$id)->orderby('order_id','asc')->get();
        return view('sevkmamul.report',compact('sevkmamul','sevkmamuldetail'));
    }
}
