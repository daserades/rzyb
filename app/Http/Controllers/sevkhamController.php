<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\sevkham;
use Yajra\Datatables\Datatables;
use App\models\sevkham_detail;
use App\models\firma;
use App\models\kkform;
use App\models\ball;
use App\models\firmatipi;
use App\models\boyahane;
use Auth;
use DB;
class sevkhamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sevkham.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $firma=firma::get();
        $firmatipi=firmatipi::get();
        $boyahane=boyahane::get();
        return view('sevkham.create',compact('firma','firmatipi','boyahane'));
    }
    public function fdetay($id)
    {
        $firma= firma::where('id',$id)->select('adres1')->get();
        return $firma;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sevkham = new sevkham ([
            'firma_id'=>$request->get('firma_id'),
            'firmatipi_id'=>$request->get('firmatipi_id'),
            'boyahane_id'=>$request->get('boyahane_id'),
            'trh'=>$request->get('trh'),
            'irsaliyeno'=>$request->get('irsaliyeno'),
            'adres'=>$request->get('adres'),
            'aciklama'=>$request->get('aciklama'),
            'users_id'=>Auth::id()
        ]);
        $sevkham->save();
        //  if($request->firmatipi_id == 1 )
        //     {
        //         $kkform= kkform::join('orders','orders.id','=','kkforms.order_id')
        //                 ->leftjoin('sevkham_details','sevkham_details.kkform_id','=','kkforms.id')
        //                 ->where('orders.firma_id',$sevkham['firma_id'])
        //                 ->whereNUll('sevkham_details.id')
        //                 ->select('kkforms.id','orders.order_no','kkforms.barcode','kkforms.brutmetre','kkforms.aciklama')
        //                 ->get();
        //     }
        // else {
        //         $kkform=ball::join('orders','orders.id','=','balls.order_id')
        //                 ->select('balls.id','orders.order_no','balls.barcode','balls.brutmetre')
        //                 ->orderBydesc('balls.id')
        //                 ->get();              
        //     }
        // return view('sevkham.hamdetay',compact('sevkham','kkform'));
         return redirect('sevkham/sevkhamdetay/'.$sevkham['id'])->with(compact('sevkham')); //kkform yok
    }
    public function store2 (Request $request)
    {
        $barcode='';
        if($request->barcode) 
        {
        $kkformlist= ball::where('barcode',$request->get('barcode'))->first();
            $barcode=$request->barcode;
        ball::where('barcode',$barcode)->update(['durum_id'=>2]);
            

        } else  
        {
        $kkformlist= kkform::where('id',$request->get('kkform_id'))->first();
            $barcode=$kkformlist['barcode'];
        }

        $sevkhamdetail = new sevkham_detail ([
            'sevkham_id'=>$request->get('sevkham_id'),
            'kkform_id'=>$kkformlist['id'],
            'ball_id'=>$kkformlist['id'],
            'order_id'=>$kkformlist['order_id'],
            'barcode'=> $barcode,
            'metre'=>$kkformlist['metre'],
            'users_id'=>Auth::id()
        ]);
        $sevkhamdetail->save();
        $sevkham=sevkham::find($request->get('sevkham_id'));
        $sevkhamdetail=sevkham_detail::where('sevkham_id',$request->get('sevkham_id'))->get();
        $kkform= kkform::join('orders','orders.id','=','kkforms.order_id')
                        ->leftjoin('sevkham_details','sevkham_details.kkform_id','=','kkforms.id')
                        ->where('orders.firma_id',$sevkham['firma_id'])
                        ->whereNUll('sevkham_details.id')
                        ->select('kkforms.id','orders.order_no','kkforms.barcode','kkforms.brutmetre','kkforms.aciklama')
                        ->get();
        return redirect('sevkham/sevkhamdetay/'.$request->sevkham_id)->with(compact('sevkhamdetail','sevkham','kkform'));
        // return view('sevkham.hamdetay',compact('sevkhamdetail','sevkham','kkform'));
    }
    public function sevkdetay($id)
    {
        $sevkham = sevkham::find($id);
        $sevkhamdetail=sevkham_detail::where('sevkham_id',$id)->get();
        if ($sevkham->firmatipi_id == 1)
        {
            $kkform= kkform::join('orders','orders.id','=','kkforms.order_id')
                        ->leftjoin('sevkham_details','sevkham_details.kkform_id','=','kkforms.id')
                        ->where('orders.firma_id',$sevkham['firma_id'])
                        ->whereNUll('sevkham_details.id')
                        ->select('kkforms.id','orders.order_no','kkforms.barcode','kkforms.brutmetre','kkforms.aciklama')
                        ->get();
        }
        else {
             // $kkform=ball::join('orders','orders.id','=','balls.order_id')
             //            ->select('balls.id','orders.order_no','balls.barcode','balls.brutmetre')
             //            ->orderBydesc('balls.id')
             //            ->get();    
            $kkform= kkform::join('orders','orders.id','=','kkforms.order_id')
                        ->leftjoin('sevkham_details','sevkham_details.kkform_id','=','kkforms.id')
                        ->whereNUll('sevkham_details.id')
                        ->select('kkforms.id','orders.order_no','kkforms.barcode','kkforms.brutmetre','kkforms.aciklama')
                        ->orderBydesc('id')
                        ->get();
        }
        return view('sevkham.hamdetay',compact('sevkham','sevkhamdetail','kkform'));   
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
        $sevkham=sevkham::find($id);
        $firma=firma::get();
        $firmatipi=firmatipi::get();
        return view('sevkham.edit',compact('sevkham','firma','firmatipi'));
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
        $sevkham = sevkham::find($id);
        $sevkham ->firma_id = $request->get('firma_id');
        $sevkham ->firmatipi_id= $request->get('firmatipi_id');
        $sevkham ->trh= $request->get('trh');
        $sevkham ->irsaliyeno= $request->get('irsaliyeno');
        $sevkham ->adres= $request->get('adres');
        $sevkham ->aciklama= $request->get('aciklama');
        $sevkham ->users_id= Auth::id();
        $sevkham -> save();
        return redirect('/sevkham/sevkham')->with('success','Sevkiyat Ham Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sevkham = sevkham::find($id);
        $sevkham -> delete();
        return back()->with('success','Silindi');
    }
    public function destroy2($id)
    {
        $sevkhamdetail=sevkham_detail::find($id);
        ball::where('id',$sevkhamdetail->ball_id)->update(['durum_id'=>1]);
        $sevkhamdetail->delete();
        return redirect('sevkham/sevkhamdetay/'.$sevkhamdetail['sevkham_id']);
    }
    public function js ()
    {   
        $sevkham= sevkham::with('firma','firmatipi')->orderBy('id','DESC')->get();
        return Datatables::of($sevkham)
          ->addColumn('action', function ($sevkham) {
                $a ='<table><tr>';
                $a .='<td><a href="report/'.$sevkham->id.'" style="color:black" target="blank" title="Sevk Detay"><i class="fas fa-desktop fa-2x"></i></a></td>';
                if(!auth()->user()->hasRole('konfeksiyon plan'))$a .='<td><a href="sevkhamdetay/'.$sevkham->id.'" style="color:black" target="blank" title="Sevkiyat"><i class="fas fa-truck-loading fa-2x"></i></a></td>';
                if(!auth()->user()->hasRole('konfeksiyon plan'))$a .='<td><a href="sevkham/'.$sevkham->id.'/edit" style="color:black" target="blank" title="Düzenle"><i class="far fa-edit fa-2x"></i></a></td>';
                if(!auth()->user()->hasRole('konfeksiyon plan'))$a .='<td><div class="delete-form">
                    <form action="sevkham/'.$sevkham->id.'" method="POST">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                     <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm("Silmek İstediğinize Emin Misiniz?")"><i class="far fa-trash-alt"></i></button>
                    </form>
                 </div></td>';
                $a .= '</tr></table>';
                return $a;
            })
            ->removeColumn('password')
            ->make(true);     
    }
    public function report($id)
    {
        $sevkham= sevkham::where('id',$id)->first();
        $sevkhamdetail= sevkham_detail::where('sevkham_id',$id)->orderby('order_id','asc')->get();
        return view('sevkham.report',compact('sevkham','sevkhamdetail'));
    }
}
