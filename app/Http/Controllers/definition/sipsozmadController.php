<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\sipsozmad;

class sipsozmadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sipsozmad=sipsozmad::paginate(10);
        return view('definition.sipsozmad.index',compact('sipsozmad'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.sipsozmad.create');
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
            'turkce'=>'required',
            'english'=>'required']);
        $sipsozmad = new sipsozmad([
            'turkce'=> $request ->get('turkce'),
            'english'=>$request ->get('english')
        ]);
        $sipsozmad->save();
        return redirect('/sipsozmad/sipsozmad')->with('success','Sözleşme Maddesi Ekleme Başarılı..');
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
        $sipsozmad=sipsozmad::find($id);
        return view('definition.sipsozmad.edit',compact('sipsozmad'));
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
            'turkce' => 'required',
            'english' => 'required']);
        $sipsozmad = sipsozmad::find($id);
        $sipsozmad ->turkce = $request->get('turkce');
        $sipsozmad ->english= $request->get('english');
        $sipsozmad -> save();
        return redirect('/sipsozmad/sipsozmad')->with('success','Sözleşme Maddesi Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sipsozmad = sipsozmad::find($id);
        $sipsozmad -> delete();
        return redirect('/sipsozmad/sipsozmad')->with('success','Sözleşme Maddesi Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = sipsozmad::where('turkce','like','%'.$search.'%')->paginate(10);
        return view('definition.sipsozmad.index',['sipsozmad'=> $posts]);
    }
}
