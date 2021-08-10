<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\iplikcins;

class iplikcinsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $iplikcins=iplikcins::paginate(10);
        return view('definition.iplikcins.index',compact('iplikcins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.iplikcins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // departman::create($request->all());
        //return back()->with('sucses','Departman Eklema Başarılı..');
        $request->validate([
            'name'=>'required']);
        $iplikcins = new iplikcins([
            'name'=> $request ->get('name')]);
        $iplikcins->save();
        return redirect('/iplikcins/iplikcins')->with('success','İplik Cinsi Ekleme Başarılı..');
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
        echo "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $iplikcins=iplikcins::find($id);
        return view('definition.iplikcins.edit',compact('iplikcins'));
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
            'name' => 'required']);
        $iplikcins = iplikcins::find($id);
        $iplikcins ->name = $request->get('name');
        $iplikcins -> save();
        return redirect('/iplikcins/iplikcins')->with('success','İplik Cinsi Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $iplikcins = iplikcins::find($id);
        $iplikcins -> delete();
        return redirect('/iplikcins/iplikcins')->with('success','İplik Cinsi Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = iplikcins::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.iplikcins.index',['iplikcins'=> $posts]);
    }
}
