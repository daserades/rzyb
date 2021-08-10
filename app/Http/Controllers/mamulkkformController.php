<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\models\mamulkkform;
use App\models\order;
use Auth;


class mamulkkformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mamulkkform=mamulkkform::paginate(20);
        return view('mamulkkform.index', compact('mamulkkform'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
    {
        $order= order::where('ordertur_id',2)->orwhere('ordertur_id',3)->orderby('order_no','asc')->get();
        return view('mamulkkform.create',compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
       $metre = str_replace(['.', ','], [',', '.'], $request ->get('metre'));
        $brutmetre = str_replace(['.', ','], [',', '.'], $request ->get('brutmetre'));
        $kg = str_replace(['.', ','], [',', '.'], $request ->get('kg'));
        $mamulkkform = new mamulkkform([
            'order_id'=> $request ->get('order_id'),
            'topno'=>$request ->get('topno'),
            'metre'=>$metre,
            'brutmetre'=>$brutmetre,
            'kg'=>$kg,
            'kumaseni'=>$request ->get('kumaseni'),
            'ebat'=>$request ->get('ebat'),
            'trh'=>$request ->get('trh'),
            'makina'=>$request ->get('makina'),
            'aciklama'=>$request ->get('aciklama'), 
            'users_id'=>Auth::id()
        ]);
        $mamulkkform->save();
        return redirect('/mamulkkform/mamulkkform/create')->withInput()->with('success','KK Form Ekleme Başarılı..');

    }   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    {
        $mamulkkform=mamulkkform::where('order_id',$id)->get();
        //$toplam=mamulkkform::where('order_id',$id)->get();
        return view('mamulkkform.show',compact('mamulkkform'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mamulkkform=mamulkkform::find($id);
        $order= order::get();
        return view('mamulkkform.edit',compact('mamulkkform','order'));
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
        $metre = str_replace(['.', ','], [',', '.'], $request ->get('metre'));
        $brutmetre = str_replace(['.', ','], [',', '.'], $request ->get('brutmetre'));
        $kg = str_replace(['.', ','], [',', '.'], $request ->get('kg'));
        $mamulkkform = mamulkkform::find($id);
        $mamulkkform ->order_id = $request->get('order_id');
        $mamulkkform ->topno= $request->get('topno');
        $mamulkkform ->metre= $metre;
        $mamulkkform ->brutmetre= $brutmetre;
        $mamulkkform ->kg= $kg;
        $mamulkkform ->kumaseni= $request->get('kumaseni');
        $mamulkkform ->ebat= $request->get('ebat');
        $mamulkkform ->trh= $request->get('trh');
        $mamulkkform ->makina=$request->get('makina');
        $mamulkkform ->aciklama= $request->get('aciklama');
        $mamulkkform ->users_id= Auth::id();
        $mamulkkform -> save();
        return redirect('/mamulkkform/mamulkkform')->with('success','KK Form Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mamulkkform = mamulkkform::find($id);
        $mamulkkform -> delete();
        return redirect('/mamulkkform/mamulkkform')->with('success','KK Form Silindi');
    }
    public function js ()
    {   
        $mamulkkform= mamulkkform::with('order')
                    ->orderBy('mamulkkforms.id','DESC')->get();
        return Datatables::of($mamulkkform)
          ->addColumn('action', function ($mamulkkform) {
                $a= '<table><tr>';
                $a .= '<td><a href="mamulkkform/'.$mamulkkform->order_id.'" title="Detay" style="color:black" target="blank"><i class="fas fa-desktop fa-2x"></i></a></td>';
               if(!auth()->user()->hasRole('konfeksiyon plan')) $a .= '<td><a href="mamulkkform/'.$mamulkkform->id.'/edit" style="color:black" title="Düzenle" target="blank"><i class="far fa-edit fa-2x"></i></a></td>';
               if(!auth()->user()->hasRole('konfeksiyon plan')) $a .= '<td><div class="delete-form">
                    <form action="mamulkkform/'.$mamulkkform->id.'" method="POST">
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
}
