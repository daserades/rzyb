<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\control1;
use App\models\control2;
use App\models\personel;

class control1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('control.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personel=personel::get();
        return view('control.report',compact('personel'));
    }
    public function control2()
    {
        $personel=personel::get();
        return view('control.report2',compact('personel'));
    }

    public function reportpost(Request $request)
    {
     $gtrh=strtotime($request->gtrh);    
     // return date('Y',$gtrh);
     $personel=personel::find($request->personel_id);
     $control=new control1;
     if(isset($request->ctrh))$control=$control->where([['date','>',$request->gtrh],['date','<',$request->ctrh]]);
     else $control=$control->where([['year',date('Y',$gtrh)],['month',date('m',$gtrh)],['day',date('d',$gtrh)]]);
     $control=$control->where('no',$personel->no)->get();
        $data=[]; 
        foreach ($control->where('control',1) as $list) {
            $a=[];
            $last=$control->where('id','>',$list->id)->first();
            $ctrh=$control->where('control',2)->where('date','>',$list->date)->where('month',$list->month)->where('day',$list->day)->where('date','<',$last->date)->pluck('date')->first();
            if(empty($ctrh)) $ctrh=$control->where('control',2)->where('date','>',$list->date)->where('month',$list->month)->where('day',$list->day)->pluck('date')->first();
           $period= date_diff(date_create($ctrh), date_create($list->date));
            // print_r('ctrh='.$ctrh.' gtrh='.$list->date.' Fark='.$period->h.':'.$period->i.':'.$period->s.'<br>');
            array_push($a,["gtrh"=>$list->date,"ctrh"=>$ctrh,"fark"=>$period->h.':'.$period->i.':'.$period->s,'personel'=>$personel]);
            array_push($data,$a); 
            unset($a);
        }
        $personel=personel::get();
        // return $data;
        // return response()->json($data);
        // return view('control.report')->with(compact('data'));
        return view('control.report')->with(compact('data','personel'));
    }
    public function reportpost2(Request $request)
    {
     $gtrh=strtotime($request->gtrh);    
     // return date('Y',$gtrh);
     $personel=personel::find($request->personel_id);
     $control=new control2;
     if(isset($request->ctrh))$control=$control->where([['date','>',$request->gtrh],['date','<',$request->ctrh]]);
     else $control=$control->where([['year',date('Y',$gtrh)],['month',date('m',$gtrh)],['day',date('d',$gtrh)]]);
     $control=$control->where('no',$personel->no)->get();
        $data=[]; 
        foreach ($control->where('control',3) as $list) {
            $a=[];
            $last=$control->where('id','>',$list->id)->first();
            $ctrh=$control->where('control',4)->where('date','>',$list->date)->where('month',$list->month)->where('day',$list->day)->where('date','<',$last->date)->pluck('date')->first();
            if(empty($ctrh)) $ctrh=$control->where('control',4)->where('date','>',$list->date)->where('month',$list->month)->where('day',$list->day)->pluck('date')->first();
           $period= date_diff(date_create($ctrh), date_create($list->date));
            // print_r('ctrh='.$ctrh.' gtrh='.$list->date.' Fark='.$period->h.':'.$period->i.':'.$period->s.'<br>');
            array_push($a,["gtrh"=>$list->date,"ctrh"=>$ctrh,"fark"=>$period->h.':'.$period->i.':'.$period->s,'personel'=>$personel]);
            array_push($data,$a); 
            unset($a);
        }
        $personel=personel::get();
        // return $data;
        // return response()->json($data);
        // return view('control.report')->with(compact('data'));
        return view('control.report2')->with(compact('data','personel'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $uzantı=$request->file->getClientOriginalExtension();
        $file= fopen($request->file,"r");
        while(!feof($file))
        {
            $content=fgets($file);
            $explode=explode(",",$content);
            if($explode[0] == 001 || $explode[0] == 002)
            {    
            if(isset($explode[2])) $last=explode(" ",$explode[2]);
            $durum_id=$last[0];
            $day=$last[1];
            $date=$last[2];
            if(isset($explode[0]))$control1=$explode[0];
            if(isset($explode[1]))$personelno=$explode[1];
            $day = str_replace('/', '-', $day);
            $dayexp=explode('-',$day);
            $dateexp=explode(':',$date);
            $date=$day.' '.$date;
            control1::create([
                'control'=>$control1,
                'no'=>$personelno,
                'type'=>$durum_id,
                'date'=>$date,
                'year'=>$dayexp[0],
                'month'=>$dayexp[1],
                'day'=>$dayexp[2],
                'hour'=>$dateexp[0],
                'minute'=>$dateexp[1],
                'second'=>$dateexp[2]
            ]);
            }
            else if($explode[0] == 003 || $explode[0] == 004)    
            {
                if(isset($explode[2])) $last=explode(" ",$explode[2]);
            $durum_id=$last[0];
            $day=$last[1];
            $date=$last[2];
            if(isset($explode[0]))$control1=$explode[0];
            if(isset($explode[1]))$personelno=$explode[1];
            $day = str_replace('/', '-', $day);
            $dayexp=explode('-',$day);
            $dateexp=explode(':',$date);
            $date=$day.' '.$date;
            control2::create([
                'control'=>$control1,
                'no'=>$personelno,
                'type'=>$durum_id,
                'date'=>$date,
                'year'=>$dayexp[0],
                'month'=>$dayexp[1],
                'day'=>$dayexp[2],
                'hour'=>$dateexp[0],
                'minute'=>$dateexp[1],
                'second'=>$dateexp[2]
            ]);
            }
            // echo 'makina--->'.$control1.'--- Per--->'.$personelno.'--- durum--->'.$durum_id.'--- day--->'.$day.'--- date--->'.$date.'<br>';
        }
        fclose($file);
        return back()->with('success','Başarılı..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $personel=personel::find($id);
        $control=control1::where('no',$personel->no)->get();
        $array=[]; $a=[];
        $i=1;
        foreach ($control->where('control',1) as $list) {
            $last=$control->where('id','>',$list->id)->first();
            // print_r($i.'--'.$list->date);
            // print_r('---'.$control->where('control',2)->where('date','>',$list->date)->where('month',$list->month)->where('day',$list->day)->where('date','<',$last->date)->pluck('date')->first());
            // echo '<br>';
            $ctrh=$control->where('control',2)->where('date','>',$list->date)->where('month',$list->month)->where('day',$list->day)->where('date','<',$last->date)->pluck('date')->first();
           $period= date_diff(date_create($ctrh), date_create($list->date));
            // $period= strtotime($ctrh) - strtotime($list->date);
            // print_r(date('Y-m-d',strtotime(str_replace('/','-',$period))).'<br>');
            // date('d-m-Y', strtotime($list->gtrh))
            // $kalan=explode(".", $period);
            // echo ($kalan[0]).'<br>';
             // $r='2020/10/19 15:43:36'; $t='2020/10/19 15:58:21';
             // echo  date('H:i:s', (strtotime($t) - strtotime($r))) .'we<br>';
            // echo ($period/60).'<br>'; //date('H:i:s',$period).'<br>';
            print_r($i.'= ctrh='.$ctrh.' gtrh='.$list->date.' Fark='.$period->h.':'.$period->i.':'.$period->s.'<br>');
            // print_r($i.'--'.($period/60).'<br>');
            // print_r($ctrh.'---'.$list->date.'<br>');
            // array_push($a,$list->date,$ctrh);array_push($array,$a);
            $i++;
        }
        // print_r($array);
        //     echo '<br>';
        // foreach ($control->where('control',2) as $list) {
        //     print_r($i.'--'.$list->date.'<br>');
        //     }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
