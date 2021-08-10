<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;    
use Auth;
use App\models\iplikbukum;
use App\models\iplikbukumdetail;
use App\models\iplikirsaliye;
use App\models\iplikdepo;
use App\models\order;
use App\models\firma;

class iplikbukumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('iplikbukum.index');
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
        return view('iplikbukum.create',compact('firma','order'));
    }

    public function create2($id)
    {
        $iplikbukum=iplikbukum::find($id);
        /*$iplikdepo=iplikdepo::with(['iplikbukumdetail'=>function($q) use ($id)
            {
              $q->where('iplikbukum_id','!=',$id);     
            }])->get();
          $iplikdepo= iplikdepo::whereHas('iplikbukumdetail',function($query){
            $query->whereNull('id');
        })->get();
        return $iplikdepo; */
            $iplikdepo=iplikdepo::with('iplikcins','boyacins','unit')->leftjoin('iplikbukumdetails','iplikbukumdetails.iplikdepo_id','=','iplikdepos.id')
                                    ->select('iplikdepos.*')
                                    ->wherenull('iplikbukumdetails.iplikbukum_id')
                                    ->orwhere('iplikbukumdetails.iplikbukum_id','!=',$id)
                                    ->get();
                                    //return $iplikdepo;
        $iplikbukumdetail=iplikbukumdetail::where('iplikbukum_id',$id)->get();
        return view('iplikbukum.create2',compact('iplikbukum','iplikdepo','iplikbukumdetail'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $no = iplikbukum::where('no','like',date('Ymd').'%')->select('no')->orderBy('no','desc')->first();
      if($no)
      {
        $getno = mb_substr($no->no,-3,null,'utf8');$getno=$getno+1;
        $sno=str_pad($getno,3,"0",STR_PAD_LEFT);
        $no= date('Ymd').$sno;
      }
      else $no= date('Ymd').'001';
        $iplikbukum =  new iplikbukum([
            'no' => $no,
            'firma_id' => $request->get('firma_id'),
            'order_id' => $request->get('order_id'),
            'aciklama' => $request->get('aciklama'),
            'users_id' => Auth::id()
        ]);
        $iplikbukum->save();
        return redirect('iplikbukum/create2/'.$iplikbukum['id']);
    }

    public function store2(Request $request)
    {
        $iplikdepo=iplikdepo::find($request->get('iplikdepo_id'));
        $request['iplikirsaliyedetail_id']=$iplikdepo->iplikirsaliyedetail_id; 
        $request['iplikno']=$iplikdepo->iplikno;
        $request['ne']=$iplikdepo->ne;
        $request['iplikcins_id']=$iplikdepo->iplikcins_id;
        $request['renkno']=$iplikdepo->renkno;
        $request['renknosim']=$iplikdepo->renknosim;
        iplikbukumdetail::create($request->all());
        $bukum=iplikbukum::find($request->get('iplikbukum_id'));
        $bukum->name .= $iplikdepo->iplikno.'/'.$iplikdepo->ne.$iplikdepo->iplikcins->name.$iplikdepo->renk.$iplikdepo->renkno.' +'; 
        $bukum->save(); 
        return back()->withInput()->with('success','Ekleme Başarılı..');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $iplikbukum=iplikbukum::with('iplikbukumdetail')->find($id);
        return view('iplikbukum.show',compact('iplikbukum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  $iplikbukum=iplikbukum::find($id);
      $order= order::get();
      $firma= firma::get();
      return view('iplikbukum.edit', compact('iplikbukum','firma','order'));
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
     $iplikbukum = iplikbukum::find($id);
     $iplikbukum ->order_id= $request->get('order_id');
     $iplikbukum ->name= $request->get('name');
     $iplikbukum ->firma_id= $request->get('firma_id');
     $iplikbukum ->aciklama= $request->get('aciklama');
     $iplikbukum ->users_id= Auth::id();
     $iplikbukum -> save();
     return redirect('/iplikbukum/iplikbukum')->with('success','Güncellendi');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $iplikbukum = iplikbukum::find($id);
     $iplikbukum -> delete();
     return redirect('/iplikbukum/iplikbukum')->with('success','Hareket Silindi');
    }
    public function destroy2($id)
    {
        $iplikbukumdetail = iplikbukumdetail::find($id);
     $iplikbukumdetail -> delete();
     return back()->with('success','Hareket Silindi');
    }
    public function js()
    {
        $iplikbukum = iplikbukum::with('firma','order','iplikirsaliye')->orderbydesc('id')->get();
        return Datatables::of($iplikbukum)
    ->addColumn('action', function ($iplikbukum) {
      $table= '<table><tr>';
      /*if($iplikbukum->iplikirsaliye['id'] == null) 
      { */    
            $table .='<td><a href="iplikbukum/'.$iplikbukum->id.'" title="Detay" target="blank" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>';
            if(!auth()->user()->hasRole('konfeksiyon plan')){$table .='<td><a href="'.route('bukumcreate2',$iplikbukum->id).'" title="Talimat Giriş" style="color:black"><i class="fas fa-plus-circle fa-1x"></i></a></td>';
            $table .='<td><a href="iplikbukum/'.$iplikbukum->id.'/edit" style="color:black" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>';
            $table .='<td class="sil"><div class="delete-form">
            <form action="iplikbukum/'.$iplikbukum->id.'" method="POST">
            <input type="hidden" name="_token" value="'.csrf_token().'">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" style="color:red" title="Sil"><i class="far fa-trash-alt"></i></button>
            </form></div></td>';}
        //}else $table .= '<td>Talimat Gerçekleşti</td>';
      $table .='</tr></table>';

      return $table;
    })
    ->removeColumn('password')
    ->make(true);
    }
}
