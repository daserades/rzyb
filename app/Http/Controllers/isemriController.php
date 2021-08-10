<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\models\isemri;
use App\models\order;
use App\models\desen;
use App\models\varyant;
use Auth;

class isemriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        return view('isemri.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $desen = desen::where('id',$id)->first();
        $varyantweft=varyant::where('desen_id',$id)->where('iplikseridi_id',1)->get();
        $varyantwarp=varyant::where('desen_id',$id)->where('iplikseridi_id',2)->get();
        return view('isemri.create', compact('desen','varyantweft','varyantwarp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $isemrino = isemri::where('no','like','Z-'.date('Ymd').$request ->get('desen_id').'%')->select('no')->orderBy('no', 'desc')->first();
         if($isemrino) 
         {
         $getno = mb_substr($isemrino->no, -2, null, 'utf8'); $getno = $getno+1;
         $no=str_pad($getno, 2 , "0",STR_PAD_LEFT);
         $isemri_no =  'Z-'.date('Ymd').$request ->get('desen_id').$no; 
         }
         else $isemri_no =  'Z-'.date('Ymd').$request ->get('desen_id').'01';
        $orderno= desen::where('id',$request ->get('desen_id'))->select('order_id')->first();
          $isemri = new isemri([
            'no'=> $isemri_no,
            'desen_id' => $request ->get('desen_id'),
            'order_id' => $orderno,
            'parca_sayisi'=>$request ->get('parca_sayisi'),
            'leventadet'=>$request ->get('leventadet'),
            'cozgu_metre'=>$request ->get('cozgu_metre'),
            'sip_fazlasi'=>$request ->get('sip_fazlasi'),
            'aciklama'=>$request ->get('aciklama'),
            'users_id'=>Auth::id()
        ]);
        $isemri->save();
        return redirect('/isemri/isemri')->with('success','İş Emri Ekleme Başarılı..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $isemri = isemri::find($id);
        return view('isemri.show',compact('isemri','desen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $isemri=isemri::find($id);
        $desen = desen::get();
        return view('isemri.edit',compact('isemri','desen'));
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
        $isemri = isemri::find($id);
        $isemri ->desen_id= $request->get('desen_id');
        $isemri ->parca_sayisi= $request->get('parca_sayisi');
        $isemri ->leventadet= $request->get('leventadet');
        $isemri ->cozgu_metre= $request->get('cozgu_metre');
        $isemri ->sip_fazlasi= $request->get('sip_fazlasi');
        $isemri ->aciklama= $request->get('aciklama');
        $isemri ->users_id=Auth::id();
        $isemri->save();
        return redirect('/isemri/isemri')->with('success','İş Emri Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isemri = isemri::find($id);
        $isemri -> delete();
        return redirect('/isemri/isemri')->with('success','İş Emri Silindi');
    }/*
    public function aaajs ()
    {   
        $isemri= isemri::isemriBy('id','DESC')->get();
        return Laratables::recordsOf($isemri);

        ->addColumn('firma', function ($isemris) {
            return $isemri->firma->name;})
    }
     */
    public function js ()
    {   
        $desen= desen::with('order','isemri')->orderBy('id','DESC')->get();
        return Datatables::of($desen)
          ->addColumn('action', function ($desen) {
                return '<table><tr>
                <td><a href="'.$desen->id.'" title="İş Emri Oluştur" style="color:black"><i class="fas fa-plus-circle fa-2x"></i></a></td>
                <td><div class="delete-form">
                    <form action="isemri/'.$desen->id.'" method="POST">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                     <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm("Silmek İstediğinize Emin Misiniz?")"><i class="far fa-trash-alt"></i></button>
                    </form>
                 </div></td></tr></table>';
            })
            ->removeColumn('password')
            ->make(true);
            
    }
}
