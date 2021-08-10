<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;    
use App\models\iplikboya;
use App\models\iplikboyadetail;
use App\models\iplikseridi;
use App\models\iplikdepo;
use App\models\iplikirsaliye;
use App\models\order;
use App\models\firma;
use App\models\kur;
use Auth;

class iplikboyaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('iplikboya.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $firma=firma::get();
        $order=order::get();
        return view('iplikboya.create',compact('firma','order'));
    }

    public function create2($id)
    {
       $iplikboya=iplikboya::find($id);
        $iplikboyadetail=iplikboyadetail::with('kur')->where('iplikboya_id',$id)->get();
        $order=order::whereId($iplikboya->order_id)->with('orderdetailwarp','orderdetailweft')->first();
        $kur=kur::get();
        return view('iplikboya.create2',compact('order','iplikboya','iplikboyadetail','kur'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $no = iplikboya::where('no','like','Y'.date('Ymd').'%')->select('no')->orderBy('no','desc')->first();
      if($no)
      {
        $getno = mb_substr($no->no,-3,null,'utf8');$getno=$getno+1;
        $sno=str_pad($getno,3,"0",STR_PAD_LEFT);
        $no= 'Y'.date('Ymd').$sno;
      }
      else $no= 'Y'.date('Ymd').'001';
        $iplikboya =  new iplikboya([
            'no' => $no,
            'firma_id' => $request->get('firma_id'),
            'order_id' => $request->get('order_id'),
            'aciklama' => $request->get('aciklama'),
            'users_id' => Auth::id()
        ]);
        $iplikboya->save();
        return redirect('iplikboya/create2/'.$iplikboya['id']);
    }

    public function store2(Request $request)
    {
       $iplikboyadetail= iplikboyadetail::Where([['iplikboya_id',$request->iplikboya_id],['orderdetail_id',$request->orderdetail_id]])->first();
        if (empty($iplikboyadetail))
        iplikboyadetail::create($request->all());
        else 
        iplikboyadetail::Where([['iplikboya_id',$request->iplikboya_id],['orderdetail_id',$request->orderdetail_id]])->update($request->all());
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $iplikboya=iplikboya::where('id',$id)->with('order','firma','iplikboyadetail.orderdetailwarp','iplikboyadetail.orderdetailweft')->first();
        return view('iplikboya.show',compact('iplikboya'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  $iplikboya=iplikboya::find($id);
      $firma= firma::get();
      $order= order::get();
      return view('iplikboya.edit', compact('iplikboya','order','firma'));
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
     $iplikboya = iplikboya::find($id);
     $iplikboya ->firma_id= $request->get('firma_id');
     $iplikboya ->order_id= $request->get('order_id');
     $iplikboya ->aciklama= $request->get('aciklama');
     $iplikboya ->users_id= Auth::id();
     $iplikboya -> save();
     return redirect('/iplikboya/iplikboya')->with('success','Güncellendi');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $iplikboya = iplikboya::find($id);
     $iplikboya -> delete();
     return redirect('/iplikboya/iplikboya')->with('success','Hareket Silindi');
    }
    public function destroy2($id)
    {
        $iplikboyadetail = iplikboyadetail::find($id);
     $iplikboyadetail -> delete();
     return back()->with('success','Hareket Silindi');
    }
    public function js()
    {
        $iplikboya = iplikboya::with('firma','order')->orderByDesc('id')->get();
        return Datatables::of($iplikboya)
    ->addColumn('action', function ($iplikboya) {
      $table= '<table><tr>';
            $table .='<td><a href="iplikboya/'.$iplikboya->id.'" title="Detay" target="_blank" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>';
            $table .='<td><a href="'.route('boyacreate2',$iplikboya->id).'" title="Talimat Giriş" style="color:black"><i class="fas fa-plus-circle fa-1x"></i></a></td>';
            $table .='<td><a href="iplikboya/'.$iplikboya->id.'/edit" style="color:black" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>';
            $table .='<td class="sil"><div class="delete-form">
            <form action="iplikboya/'.$iplikboya->id.'" method="POST">
            <input type="hidden" name="_token" value="'.csrf_token().'">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" style="color:red" title="Sil"><i class="far fa-trash-alt"></i></button>
            </form></div></td>';
      $table .='</tr></table>';

      return $table;
    })
    ->removeColumn('password')
    ->make(true);
    }
    public function report()
    {
        $iplikboya=iplikboya::with('iplikboyadetail.iplikirsaliyedetail')->get();
        return $iplikboya;
    }
}
