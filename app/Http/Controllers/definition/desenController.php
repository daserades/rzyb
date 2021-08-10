<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Storage;
use App\models\onay;
use App\models\desen;
use Auth;
use File;
use App\models\patterndetail;
class desenController extends Controller
{
    /**
     * Display a listing of the resource.
namespace App\Http\Requests;
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('definition.desen.index');
    }

    public function images($id)
    {
        $desen=desen::where('id',$id)->select('id')->first();
        return view('definition.desen.images',compact('desen'));
    }
     
    public function create()
    {
        return view('definition.desen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $desen = new desen([
            'name'=> $request ->get('name'),
            'no'=>'D'.$request ->get('no'),
            'varyant' => $request ->get('varyant'),
            'order_no' => $request ->get('order_no'),
            'atki_sikligi' => $request ->get('atki_sikligi'),
            'cts'=>$request ->get('cts'),
            'tarak_eni'=>$request ->get('tarak_eni'),
            'faydali_tarak_eni'=>$request ->get('faydali_tarak_eni'),
            'tarak'=>$request ->get('tarak'),
            'tarak_no'=>$request ->get('tarak_no'),
            'ham_en'=>$request ->get('ham_en'),
            'ham_boy'=>$request ->get('ham_boy'),
            'ham_gr'=>$request ->get('ham_gr'),
            'mamul_en'=>$request ->get('mamul_en'),
            'mamul_boy'=>$request ->get('mamul_boy'),
            'mamul_gr'=>$request ->get('mamul_gr'),
            'cozgu_sikligi'=>$request ->get('cozgu_sikligi'),
            'armur'=>$request ->get('armur'),
            'tahar'=>$request ->get('tahar'),
            'kenargenisligi'=>$request ->get('kenargenisligi'),
            'aciklama'=>$request ->get('aciklama')
        ]);
        $desen->save();


   $filename=$desen['id'];
   $resimler = $request->file('resimler'); 
   if (!empty($resimler))
    {   $i=1;
      foreach ($resimler as $resim) {
       $resim_uzantı=$resim->getClientOriginalExtension();
       $resim_isim=$filename.'-'.$i.'.'.$resim_uzantı;
       Storage::disk('uploads')->put($filename.'/'.$resim_isim,file_get_contents($resim));
       desen::where('id',$desen->id)->update(['picture'=>$i]);
       $i++;
     }
   }

   // $taharname=$desen['id'];
   // $taharlar = $request->file('tahar'); 
   // if (!empty($taharlar))
   //  {   $i=1;
   //    foreach ($taharlar as $tahar) {
   //     $resim_uzantı=$tahar->getClientOriginalExtension();
   //     $resim_isim=$taharname.'-'.$i.'.'.$resim_uzantı;
   //     Storage::disk('uploads')->put($taharname.'/'.$resim_isim,file_get_contents($tahar));
   //     // desen::where('id',$desen->id)->update(['picture'=>$i]);
   //     $i++;
   //   }
   // }

        onay::create(['sipdurum_id'=>3,'table'=>'desen','table_id'=>$desen['id'],'users_id'=>Auth::id()]);
        return redirect('/desen/'.$desen['id'])->with('success','Desen Ekleme Başarılı..');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $desen=desen::find($id);
        $patterndetail = patterndetail::where('desen_id','=',$id)->get(); 
        return view('definition.desen.show',compact('desen','patterndetail'));
    }
     public function show2($id)
    {

       $desen= desen::where('id',$id)->with('order','orderdetailwarp','orderdetailweft')->first();
        return view('definition.desen.show2',compact('desen'));
    }

     public function report($id)
    {
        $desen=desen::with('patterndetail','patternwarp')->find($id);
        return view('definition.desen.report',compact('desen'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $desen = desen::find($id);
        return view('definition.desen.edit',compact('desen'));
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
        $filename=$id;
      $resimler = $request->file('resimler'); 
      if (!empty($resimler))
      {  
        $q=desen::where('id',$id)->select('picture')->first();
        $resimsayi= $q->picture; $resimsayi++;

        if( $q->picture > 0 )
        {
         $i=$resimsayi;
         foreach ($resimler as $resim) 
         {
           $resim_uzantı=$resim->getClientOriginalExtension();
           $resim_isim=$filename.'-'.$i.'.'.$resim_uzantı;
           Storage::disk('uploads')->put($filename.'/'.$resim_isim,file_get_contents($resim));
           desen::where('id',$id)->update(['picture'=>$i]);
           $i++;
         }
       }
       else 
       {
            $i=1;
        foreach ($resimler as $resim) 
        {
         $resim_uzantı=$resim->getClientOriginalExtension();
         $resim_isim=$filename.'-'.$i.'.'.$resim_uzantı;
         Storage::disk('uploads')->put($filename.'/'.$resim_isim,file_get_contents($resim));
           desen::where('id',$id)->update(['picture'=>$i]);
           $i++;
       }  
     }
   } 
        //ord($harf)
        $desen = desen::find($id);
        $desen ->name = $request->get('name');
        $desen ->no= $request->get('no');
        $desen ->varyant= $request->get('varyant');
        $desen ->order_no= $request->get('order_no');
        $desen ->atki_sikligi= $request->get('atki_sikligi');
        $desen ->cts= $request->get('cts');
        $desen ->tarak_eni= $request->get('tarak_eni');
        $desen ->faydali_tarak_eni= $request->get('faydali_tarak_eni');
        $desen ->tarak= $request->get('tarak');
        $desen ->tarak_no= $request->get('tarak_no');
        $desen ->ham_en= $request->get('ham_en');
        $desen ->ham_boy= $request->get('ham_boy');
        $desen ->ham_gr= $request->get('ham_gr');
        $desen ->mamul_en= $request->get('mamul_en');
        $desen ->mamul_boy= $request->get('mamul_boy');
        $desen ->mamul_gr= $request->get('mamul_gr');
        $desen ->cozgu_sikligi= $request->get('cozgu_sikligi');
        $desen ->armur= $request->get('armur');
        $desen ->tahar= $request->get('tahar');
        $desen ->kenargenisligi= $request->get('kenargenisligi');
        $desen ->aciklama= $request->get('aciklama');
        $desen -> save();
        return redirect('/desen/desen')->with('success','Desen Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $desen = desen::find($id);
        $desen -> delete();
        return redirect('/desen/desen')->with('success','Desen Silindi');
    }
    public function js ()
    {
        $desen= desen::orderBy('id','DESC')->get();
        return Datatables::of($desen)
        ->addColumn('action', function ($desen) {
                $action = '';
            $action='<table><tr>';
            if(!auth()->user()->hasRole('konfeksiyon plan')) $action .='<td><a href="show2/'.$desen->id.'" title="Show2" target="blank" style="color:gray"><i class="fas fa-desktop fa-2x"></i></a></td>';
                if(!auth()->user()->hasRole('konfeksiyon plan')) $action .='<td><a href="'.route('desen.report',$desen->id).'" target="blank" title="Detaylı Çözgü Raporu" style="color:orange"><i class="fas fa-desktop fa-2x"></i></a></td>';
                $action .='<td><a href="desen/'.$desen->id.'" title="Desen Detay" target="blank" style="color:black"><i class="fas fa-desktop fa-2x"></i></a></td>';
               if(!auth()->user()->hasRole('konfeksiyon plan')) $action .=' <td><a href="'.$desen->id.'" title="İplik Girişi" target="blank" style="color:black"><i class="fas fa-plus-circle fa-2x"></i></a></td>
                <td><a href="patternwarp/'.$desen->id.'" target="blank" title="Detaylı Renk Girişi" style="color:black"><i class="fab fa-airbnb fa-2x"></i></a></td>
                <td><a href="desen/'.$desen->id.'/edit" target="blank" style="color:black" title="Düzenle"><i class="far fa-edit fa-2x"></i></a></td>';
        if(auth()->user()->can('desendelete')){
            $action .= '<td class="sil"><div class="delete-form">
                    <form action="desen/'.$desen->id.'" method="POST">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                     <button type="submit" class="btn btn-danger" title="Sil"><i class="far fa-trash-alt"></i></button>
                    </form>
                 </div></td>';
        }
         $action .='</tr></table>';
        return $action;

                 /*                 return '<table><tr>
                <td><a href="desen/'.$desen->id.'" title="Detay" style="color:black"><i class="fas fa-desktop fa-2x"></i></a></td>
                <td><a href="'.$desen->id.'" title="İplik Girişi" style="color:black"><i class="fas fa-plus-circle fa-2x"></i></a></td>
                <td><a href="patternwarp/'.$desen->id.'" title="Detaylı Renk Girişi" style="color:black"><i class="fab fa-airbnb fa-2x"></i></a></td>
                <td><a href="desen/'.$desen->id.'/edit" style="color:black" title="Düzenle"><i class="far fa-edit fa-2x"></i></a></td>
                <td><div class="delete-form">
                    <form action="desen/'.$desen->id.'" method="POST">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                     <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm("Silmek İstediğinize Emin Misiniz?")"><i class="far fa-trash-alt"></i></button>
                    </form>
                 </div></td></tr></table>';

*/
            })
            ->removeColumn('password')
            ->make(true);
    }
     public function imagedestroy($id,$no)
    {
      //return $id.'-'.$no;
      //$asd='/'.$id.'-'.$no;
      $image_path = 'storage/uploads/'.$id.'/'.$no; 
      if(file_exists($image_path)) {
          File::delete($image_path);
          return back()->with('success','Silme İşlemi Başarılı');
      }
      else return back()->with('error','Bir Sorunla Karşılaşıldı !!');

    }
    public function beetwen (Request $request)
    {
        if($request->ajax())
       {
          if($request->date != '' && $request->to_date != '')
          {
           $data = desen::all()
             ->whereBetween('date', array($request->date, $request->todate))
             ->get();
          }
          echo json_encode($data);
        }
    }
}
