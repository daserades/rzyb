<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\terbiyesureci;

class terbiyesureciController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $terbiyesureci=terbiyesureci::paginate(10);
        return view('definition.terbiyesureci.index',compact('terbiyesureci'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.terbiyesureci.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'name'=>'required',
            'surec'=>'required']);
        $terbiyesureci = new terbiyesureci([
            'name'=> $request ->get('name'),
            'surec'=>$request ->get('surec')
        ]);
        $terbiyesureci->save();
        return redirect('/terbiyesureci/terbiyesureci')->with('success','Terbiye Süreci Ekleme Başarılı..');
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
        $terbiyesureci=terbiyesureci::find($id);
        return view('definition.terbiyesureci.edit',compact('terbiyesureci'));
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
         $request->validate([
            'name' => 'required',
            'surec'=> 'required'
        ]);
        $terbiyesureci = terbiyesureci::find($id);
        $terbiyesureci ->name = $request->get('name');
        $terbiyesureci ->surec= $request->get('surec');
        $terbiyesureci -> save();
        return redirect('/terbiyesureci/terbiyesureci')->with('success','Süreç Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $terbiyesureci = terbiyesureci::find($id);
        $terbiyesureci -> delete();
        return redirect('/terbiyesureci/terbiyesureci')->with('success','Süreç Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = terbiyesureci::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.terbiyesureci.index',['terbiyesureci'=> $posts]);
    }
}
