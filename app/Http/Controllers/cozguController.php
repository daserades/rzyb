<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;    
use Auth;
use App\models\order;
use App\models\firma;
use App\models\cozgu;

class cozguController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cozgu.index');
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
        return view('cozgu.create',compact('firma','order'));
    }

    public function store(Request $request)
    {
      $no = cozgu::where('no','like','C'.date('Ymd').'%')->select('no')->orderBy('no','desc')->first();
      if($no)
      {
        $getno = mb_substr($no->no,-3,null,'utf8');$getno=$getno+1;
        $sno=str_pad($getno,3,"0",STR_PAD_LEFT);
        $no= 'C'.date('Ymd').$sno;
      }
      else $no= 'C'.date('Ymd').'001';
            $request['no'] = $no; 
            $request['users_id'] = Auth::id();
            cozgu::create($request->all());
        return redirect('cozgu/cozgu');
    }

    public function show($id)
    {
          $cozgu=cozgu::with('order.orderdetailwarp')->find($id);
        return view('cozgu.show',compact('cozgu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $cozgu=cozgu::find($id);
      $order= order::get();
      $firma= firma::get();
      return view('cozgu.edit', compact('cozgu','firma','order'));
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
        $cozgu=cozgu::find($id);
        $cozgu ->order_id= $request->get('order_id');
         $cozgu ->firma_id= $request->get('firma_id');
         $cozgu ->telsayi= $request->get('telsayi');
         $cozgu ->leventeni= $request->get('leventeni');
         $cozgu ->metraj= $request->get('metraj');
         $cozgu ->bobinadet= $request->get('bobinadet');
         $cozgu ->tip= $request->get('tip');
         $cozgu ->aciklama= $request->get('aciklama');
         $cozgu ->users_id= Auth::id();
         $cozgu -> save();
     return redirect('/cozgu/cozgu')->with('success','Güncellendi');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cozgu = cozgu::find($id);
     $cozgu -> delete();
     return redirect('/cozgu/cozgu')->with('success','Hareket Silindi');
    }
    public function destroy2($id)
    {
        $cozgudetail = cozgudetail::find($id);
     $cozgudetail -> delete();
     return back()->with('success','Hareket Silindi');
    }
    public function js()
    {
        $cozgu = cozgu::with('firma','order')->get();
        return Datatables::of($cozgu)
    ->addColumn('action', function ($cozgu) {
      $table= '<table><tr>';
      
            $table .='<td><a href="cozgu/'.$cozgu->id.'" title="Detay" target="blank" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>';
          if(!auth()->user()->hasRole('konfeksiyon plan')) {  $table .='<td><a href="cozgu/'.$cozgu->id.'/edit" style="color:black" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>';
            $table .='<td class="sil"><div class="delete-form">
            <form action="cozgu/'.$cozgu->id.'" method="POST">
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
    public function cozgubilgi($id)
    {
        $order = order::where('id',$id)->get();
        return $order;
    }
}
