<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\ebatcins;

class ebatcinsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ebatcins=ebatcins::paginate(10);
        return view('definition.ebatcins.index',compact('ebatcins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('definition.ebatcins.create');
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
            'code'=>'required']);
        $ebatcins = new ebatcins([
            'name'=> $request ->get('name'),
            'code'=> $request->get('code')]);
        $ebatcins->save();
        return redirect('/ebatcins/ebatcins')->with('success','Ebat Cinsi Ekleme Başarılı..');
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
        $ebatcins=ebatcins::find($id);
        return view('definition.ebatcins.edit',compact('ebatcins'));
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
            'code'=>'required']);
        $ebatcins = ebatcins::find($id);
        $ebatcins ->name = $request->get('name');
        $ebatcins ->code= $request->get('code');
        $ebatcins -> save();
        return redirect('/ebatcins/ebatcins')->with('success','Ebat Cinsi Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ebatcins = ebatcins::find($id);
        $ebatcins -> delete();
        return redirect('/ebatcins/ebatcins')->with('success','Ebat Cinsi Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = ebatcins::where('name','like','%'.$search.'%')
                            ->orWhere('code','like','%'.$search.'%')
                            ->paginate(10);
        return view('definition.ebatcins.index',['ebatcins'=> $posts]);
    }
}
