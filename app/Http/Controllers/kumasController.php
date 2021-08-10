<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\kumas;
use App\models\kumasdetail;
use App\models\firma;
use App\models\order;
use App\models\kur;
use App\models\ball;
use Yajra\Datatables\Datatables;
use Auth;

class kumasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kumas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $firma=firma::get();
       return view('kumas.create',compact('firma'));
   }

   public function create2($id)
   {
    $kumas=kumas::with('kumasdetail')->find($id);
    $kumasdetail=kumasdetail::where('kumas_id',$id)->get();
    $order=order::where('ordertur_id',2)->orderbydesc('id')->get();
    $kur=kur::get();
    return view('kumas.create2',compact('kumas','order','kumasdetail','kur'));
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['users_id']=Auth::id();
        $kumas=kumas::create($request->all());

        return redirect('kumas/create2/'.$kumas['id'])->with(compact('kumas'));
    }

    public function store2(Request $request)
    {
        $request['users_id']=auth::id();
        $kumasdetail=kumasdetail::where([['kumas_id',$request->kumas_id],['type',$request->type]])->first();
        if($kumasdetail)
        {
            $kumasdetail->update($request->all());
        }
        else kumasdetail::create($request->all());
        // $kumas=kumas::with('kumasdetail.order')->where('id',$request->kumas_id)->get();
        // return back()->withInput()->with('success','Ekleme Başarılı..',compact('kumas'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ball=ball::with('order.boyahanedetail','kumasdetail')->where('kumas_id',$id)->get();
        return view('kumas.show',compact('ball'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $kumas=kumas::find($id);
        $firma= firma::get();
        return view('kumas.edit', compact('kumas','firma'));
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
       $request['users_id']= Auth::id();
       $kumas = kumas::find($id)->update($request->all());

       return redirect('/kumas/kumas')->with('success','Güncellendi');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kumas = kumas::find($id);
        $kumas -> delete();
        return redirect('/kumas/kumas')->with('success','Silindi');
    }
    public function destroy2($id)
    {
        // $kumasdetail = kumasdetail::find($id);
        // $kumasdetail -> delete();
        // return back()->with('success','Hareket Silindi');
    }
    public function js()
    {
        $kumas = kumas::with('firma')->orderbydesc('id')->get();
        return Datatables::of($kumas)
        ->addColumn('action', function ($kumas) {
          $table= '<table><tr>';

          $table .='<td><a href="kumas/'.$kumas->id.'" title="Detay" target="blank" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>';
          if(!auth()->user()->hasRole('konfeksiyon plan')){$table .='<td><a href="'.route('kumascreate2',$kumas->id).'" title="Talimat Giriş" style="color:black"><i class="fas fa-plus-circle fa-1x"></i></a></td>';
          $table .='<td><a href="kumas/'.$kumas->id.'/edit" style="color:black" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>';
          $table .='<td class="sil"><div class="delete-form">
          <form action="kumas/'.$kumas->id.'" method="POST">
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

    public function sticker($id)
    {
        $ball=ball::with('order')->where('kumas_id',$id)->get();
        if(count($ball) <= 0)
        {    
            $kumasdetail=kumasdetail::where('kumas_id',$id)->get();
            foreach ($kumasdetail as $list) {

                $order=order::where('id',$list->order_id)->pluck('order_no')->first();
                    // $asd=$order.'-M';
                    $type = ball::where('barcode','like','%'.$order.'%')->orderbydesc('id')->pluck('type')->first();
                    $no = ball::where('order_id',$list->order_id)->max('no'); $no++;
                    if($type)
                    {   
                        $type= $type+1; 
                        $type=str_pad($type, 2 , "0",STR_PAD_LEFT);
                        $barcode=$order.'-M'.$type;
                        $ball=ball::create([
                            'kumas_id'=>$list->kumas_id,
                            'kumasdetail_id'=>$list->id,
                            'order_id'=>$list->order_id,
                            'barcode'=> $barcode,
                            'type'=>$type, 
                            'no'=>$no, 
                            'metre'=>$list->metre,
                            'kumaseni'=>$list->mamulen,
                            'durum_id'=>1,
                            'users_id'=>Auth::id()
                        ]);
                    }
                    else
                    {
                        $ball=ball::create([
                            'kumas_id'=>$list->kumas_id,
                            'kumasdetail_id'=>$list->id,
                            'order_id'=>$list->order_id,
                            'barcode'=>$order.'-M01',
                            'type'=>'01', 
                            'no'=>$no, 
                            'metre'=>$list->metre,
                            'kumaseni'=>$list->mamulen,
                            'durum_id'=>1,
                            'users_id'=>Auth::id()
                        ]);
                    }
            }
            $ball=ball::with('order')->where('kumas_id',$id)->get();
        }
        return view('kumas.multisticker',compact('ball')); 
    }
}
