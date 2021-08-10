<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\cozgudetail;
use App\models\cozgu;
use App\models\leventhareket;
use App\models\leventirsaliye;
use App\models\leventdepo;
use Yajra\Datatables\Datatables;    
use App\models\hareketturu;
use App\models\order;
use App\models\firma;
use App\models\durum;
use App\models\firmatipi;
use App\models\unit;
use App\models\kur;
use Auth;
use QrCode;

class leventhareketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('levent.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $hareketturu= hareketturu::get();
      $firmatipi= firmatipi::get();
      $firma= firma::get();
      return view('levent.create',compact('hareketturu','firma','firmatipi'));
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
      $leventirsaliye=leventirsaliye::create($request->all());
      if ($request->get('hareketturu_id')==2)
      {
        return redirect('leventhareket/cikis/'.$leventirsaliye['id'])->with(compact('leventirsaliye'));
      }
      elseif($request->get('hareketturu_id')==1)
      {
        return redirect('leventhareket/giris/'.$leventirsaliye['id'])->with(compact('leventirsaliye'));
      }

    }
    public function leventgiris($id)
    {
      $leventirsaliye=leventirsaliye::with('leventhareket','leventhareket.cozgu','leventhareket.kur')->find($id);
      $cozgu=cozgu::get();
      $order=order::get();
      $kur=kur::get();
      return view('levent.giris',compact('leventirsaliye','cozgu','kur','order'));
    }

    public function leventgirisdetail(Request $request)
    {
      if(isset($request->cozgu_id))$request['order_id']=cozgu::where('id',$request->cozgu_id)->pluck('order_id')->first();
      $request['hareketturu_id']=1;$request['durum_id']=1;$request['users_id']=Auth::id();

      $leventhareket=leventhareket::where([['leventirsaliye_id',$request->leventirsaliye_id],['no',$request->no]])->first();
      $leventdepo=leventdepo::where([['leventirsaliye_id',$request->leventirsaliye_id],['no',$request->no]])->first();
      if (empty($leventhareket))
      {
        if ($request->stok == 1)  $request['barcode'] =  'S'.date('ymdHis'); 
        elseif($request->stok == 0) $request['barcode'] =  'L'.date('ymdHis'); 
        $leventhareket=leventhareket::create($request->all());
        $request['leventhareket_id']=$leventhareket->id;
        $leventdepo=leventdepo::create($request->all());
      }
      else 
      {
        if(isset($leventhareket->barcode))
        {
          if ($request->stok == 1)  
          {
            $request['barcode'] =  'S'.substr($leventhareket->barcode,1); 
            $request['order_id']=null;
          }
          else $request['barcode'] =  'L'.substr($leventhareket->barcode,1); 
        }
        else 
        {
          if ($request->stok == 1)  $request['barcode'] =  'S'.date('ymdHis');
          else $request['barcode'] =  'L'.date('ymdHis'); 
        }
       $leventhareket=leventhareket::find($leventhareket->id)->update($request->all());
       $leventdepo=leventdepo::find($leventdepo->id)->update($request->all());
     }
   }
   public function girisetiket($id)
   {
    $leventdepo= leventdepo::with('cozgu.cozgudetail')->where('leventhareket_id',$id)->first();
    return view('levent.girisetiket',compact('leventdepo'));
  }
  public function toplugirisetiket($id)
  {
    $leventirsaliye= leventirsaliye::with('leventhareket.cozgu.cozgudetail')->where('id',$id)->first();
    return view('levent.toplugirisetiket',compact('leventirsaliye'));
  }

  public function leventcikis($id)
  {
    $leventirsaliye=leventirsaliye::find($id);
    $leventhareket=leventhareket::where('leventirsaliye_id',$id)->get();
    return view('levent.cikis',compact('leventirsaliye','leventhareket'));
  }

  public function leventcikisdetail(Request $request)
  {
    $leventhareket=leventhareket::where([['barcode',$request->barcode],['hareketturu_id',1]])->first();
    $leventdepo=leventdepo::where('barcode',$request->barcode)->first();
       // $request['order_id']=cozgu::where('id',$request->cozgu_id)->pluck('order_id')->first();
    if (isset($leventdepo))
    {
      if(isset($leventhareket))
      {
        $leventhareket['leventirsaliye_id']=$request->leventirsaliye_id;
        $leventhareket['hareketturu_id']=2;
        $leventhareket['users_id']=Auth::id();
        $leventhareket=leventhareket::create($leventhareket->toArray());  
        $leventdepo->delete();
        return redirect('leventhareket/cikis/'.$request->leventirsaliye_id)->with('success','Barcode Eklendi...')->with(compact('leventhareket'));
      }
      else 
      {
        return redirect('leventhareket/cikis/'.$request->leventirsaliye_id)->with('error','Hatalı Barcode!!!');
      }
    }
    else return back()->with('error','Hatalı Barcode!!');
  }
   //public function leventcikisdetail
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $leventirsaliye=leventirsaliye::with('leventhareket')->find($id);
      return view('levent.show',compact('leventirsaliye'));
    }
    public function show2($id)
    {
      $leventirsaliye=leventirsaliye::with('leventhareket')->find($id);
      return view('levent.show2',compact('leventirsaliye'));
    }
    public function show3($id) //cikis bilgilerini gönderme
    {
      $leventirsaliye=leventirsaliye::where('id',$id)->with('leventhareket.cozgu')->first();
      return view('levent.show3',compact('leventirsaliye'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $leventhareket=leventirsaliye::find($id);
      $hareketturu= hareketturu::get();
      $firmatipi= firmatipi::get();
      $firma= firma::get();
      return view('levent.edit', compact('leventhareket','firma','firmatipi','hareketturu'));
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
      leventirsaliye::find($id)->update($request->all());
      return redirect('leventhareket/leventhareket')->with('success','Güncellendi');

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

    public function leventcikisdestroy($id)
    {
      $leventhareket=leventhareket::find($id);
      $leventhareketOLD=leventhareket::where([['barcode',$leventhareket->barcode],['hareketturu_id',1]])->first();
      $leventhareket['leventhareket_id']=$leventhareketOLD->id;
      $leventhareket['leventirsaliye_id']=$leventhareketOLD->leventirsaliye_id;
      leventdepo::create($leventhareket->toArray());
      $leventhareket->delete();
      return back()->with('success','İşlme Başarılı...');

    }

    public function js ()
    {
      $leventhareket= leventirsaliye::with('hareketturu','firma','firmatipi')->orderBy('id','DESC')->get();
      return Datatables::of($leventhareket)
      ->addColumn('action', function ($leventhareket) {
        $sql= '<table><tr>';
        if($leventhareket['hareketturu_id']==1) 
        {
          $sql .='<td><a href="leventhareket/'.$leventhareket->id.'" title="Detay" target="blank" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>';
          if(!auth()->user()->hasRole('konfeksiyon plan'))$sql .='<td><a href="giris/'.$leventhareket->id.'" title="İplik Giriş" style="color:black"><i class="fas fa-plus-circle fa-1x"></i></a></td>';
        }
        if($leventhareket['hareketturu_id']==2) 
        {
          $sql .='<td><a href="show2/'.$leventhareket->id.'" title="Detay" target="blank" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>';
          if(!auth()->user()->hasRole('konfeksiyon plan'))$sql .= '<td><a href="cikis/'.$leventhareket->id.'" title="İplik Çıkış" style="color:black"><i class="fas fa-truck-loading fa-1x"></i></a></td>';
        }
        if(!auth()->user()->hasRole('konfeksiyon plan'))$sql .='<td><a href="leventhareket/'.$leventhareket->id.'/edit" style="color:black" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>
        </tr></table>';
        return $sql;
      })
      ->removeColumn('password')
      ->make(true);
    }

    public function leventdepo ()
    {
      return view('levent.leventdepo');
    }
    public function leventdepojs ()
    {
      $leventdepo= leventdepo::with('order','durum')->orderBy('id','DESC')->get();
      return Datatables::of($leventdepo)
      ->addColumn('action', function ($leventdepo) {
        $sql= '<table><tr>';
        if(!auth()->user()->hasRole('konfeksiyon plan'))$sql .='<td><a href="levent/'.$leventdepo->id.'" style="color:black" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>
        </tr></table>';
        return $sql;
      })
      ->removeColumn('password')
      ->make(true);
    }
    public function leventdepoedit($id)
    {
      $leventdepo=leventdepo::find($id);
      $durum=durum::get();
      return view('levent.leventdepoedit',compact('leventdepo','durum'));
    }
    public function leventdepostore(Request $request)
    {
      unset($request['_token']);
      $leventdepo=leventdepo::where('id',$request->id)->update($request->all());
      return redirect('leventhareket/leventdepo')->with('success','Başarılı..');
    }
  }
