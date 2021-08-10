<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;    
use Auth;
use App\models\boyahane;
use App\models\boyahanedetail;
use App\models\terbiyesureci;
use App\models\order;
use App\models\firma;
use App\models\kur;


class boyahaneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        return view('boyahane.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $firma=firma::get();
        return view('boyahane.create',compact('firma'));
    }

    public function create2($id)
    {
        $boyahane=boyahane::find($id);
        $boyahanedetail=boyahanedetail::where('boyahane_id',$id)->get();
        $order=order::get();
        $terbiyesureci=terbiyesureci::get();
        $kur=kur::get();
        return view('boyahane.create2',compact('boyahane','order','boyahanedetail','terbiyesureci','kur'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $no = boyahane::where('no','like',date('Ymd').'%')->select('no')->orderBy('no','desc')->first();
      if($no)
      {
        $getno = mb_substr($no->no,-3,null,'utf8');$getno=$getno+1;
        $sno=str_pad($getno,3,"0",STR_PAD_LEFT);
        $no= date('Ymd').$sno;
      }
      else $no= date('Ymd').'001';
        $boyahane =  new boyahane([
            'no' => $no,
            'firma_id' => $request->get('firma_id'),
            'users_id' => Auth::id()
        ]);
        $boyahane->save();
        return redirect('boyahane/create2/'.$boyahane['id']);
    }

    public function store2(Request $request)
    {
        $request['users_id']=auth::id();
        boyahanedetail::create($request->all());
        $boyahane=boyahane::with('boyahanedetail.order')->where('id',$request->boyahane_id)->get();
        return back()->withInput()->with('success','Ekleme Başarılı..',compact('boyahane'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $boyahane=boyahane::with('boyahanedetail')->find($id);
        return view('boyahane.show',compact('boyahane'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $boyahane=boyahane::find($id);
      $firma= firma::get();
      return view('boyahane.edit', compact('boyahane','firma'));
    }

    public function edit2($id)
    {  
     $boyahanedetail=boyahanedetail::with('terbiyesureci')->find($id);   
     $terbiyesureci=terbiyesureci::get();
      return view('boyahane.edit2',compact('boyahanedetail','terbiyesureci'));
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
     $boyahane = boyahane::find($id);
     $boyahane ->firma_id= $request->get('firma_id');
     $boyahane ->users_id= Auth::id();
     $boyahane -> save();
     return redirect('/boyahane/boyahane')->with('success','Güncellendi');
   }

   public function update2(Request $request)
   {
        unset($request['_token']);
        $boyahanedetail=boyahanedetail::where('id',$request->id)->update($request->all());
        return redirect('boyahane/create2/'.$request['boyahane_id']);
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $boyahane = boyahane::find($id);
     $boyahane -> delete();
     return redirect('/boyahane/boyahane')->with('success','Hareket Silindi');
    }
    public function destroy2($id)
    {
        $boyahanedetail = boyahanedetail::find($id);
     $boyahanedetail -> delete();
     return back()->with('success','Hareket Silindi');
    }
    public function js()
    {
        $boyahane = boyahane::with('firma','boyahanedetail')->orderbydesc('id')->get();
        return Datatables::of($boyahane)
    ->addColumn('action', function ($boyahane) {
      $table= '<table><tr>';

            $table .='<td><a href="boyahane/'.$boyahane->id.'" title="Detay" target="blank" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>';
            if(!auth()->user()->hasRole('konfeksiyon plan')){$table .='<td><a href="'.route('boyahanecreate2',$boyahane->id).'" title="Talimat Giriş" style="color:black"><i class="fas fa-plus-circle fa-1x"></i></a></td>';
            $table .='<td><a href="boyahane/'.$boyahane->id.'/edit" style="color:black" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>';
            $table .='<td class="sil"><div class="delete-form">
            <form action="boyahane/'.$boyahane->id.'" method="POST">
            <input type="hidden" name="_token" value="'.csrf_token().'">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" style="color:red" title="Sil"><i class="far fa-trash-alt"></i></button>
            </form></div></td>';}
      $table .='</tr></table>';

      return $table;
    })
    ->removeColumn('password')
    ->make(true);
    }

    public function order($id)
    {
        $order=order::with('ball')->where('id',$id)->get();
        return $order;
    }
}
