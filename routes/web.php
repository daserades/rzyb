<?php

Auth::routes();
Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index')->name('index');
route::get('/asdd',function(){


 $data= "BAYZARA TEKSTİL";
 echo $data;
 $top=50;

// echo "The Example uses PHP to call ActiveX DLL.";
              $PrintJob = new COM("GoDEXATL.Function");
              //$PrintJob->openport("0");
              $PrintJob->OpenNet("192.168.1.201","9100");
              $PrintJob->setup(99, 2, 3, 1, 3,0); //(height, dark, speed , mode, gap, top)
              $PrintJob->sendcommand("^L\r\n");
              $PrintJob->ecTextOut(270, $top, 50, "Arial", $data.' 50 olan ');
              $PrintJob->ecTextOut(270, $top+60, 34, "Arial", $data.'+60');
              $PrintJob->ecTextOut(270, $top+100, 34, "Arial", $data.'+100');
              $PrintJob->ecTextOut(270, $top+140, 34, "Arial", $data.'+140');
              $PrintJob->ecTextOut(270, $top+180, 34, "Arial", $data.'fıojrg +180');
              $PrintJob->ecTextOut(270, $top+220, 34, "Arial", $data.' asd +220');
              $PrintJob->ecTextOut(270, $top+260, 34, "Arial", $data.' fweof +200');
              //$PrintJob->ecTextOutR(10, 50, 34, "Arial", "ecTextOutR for test", 0, 0, 180);
              //$PrintJob->ecTextOutFine(10, 100, 34, "Arial", "ecTextOutFine for test", 0, 700, 0, 1, 0, 0, 1);
              $PrintJob->sendcommand("E\r\n");
              $PrintJob->closeport();
             // echo "End.";

/*
$printer = ("192.168.1.122");
if($ph = printer_open($printer))
{   
   $data= "Hello";
   printer_set_option($ph, PRINTER_MODE, "RAW");
   printer_write($ph, $data);
  printer_close($ph);
}
 else "Couldn't connect...";
 $ftp = ftp_connect('192.168.1.122');
if(ftp_login($ftp)){
   if(ftp_put($ftp,'filetype=PDF',$data,FTP_BINARY)){
        echo 'success';
    }
} //"GET /main/main_single_block.php?typename=" . $typename . "&templateurlarr=" . $template_url_arr_s . " HTTP/1.1\r\nHost: $sochost\r\nConnection: close\r\n\r\n";
try
{
   $data= "Hello";
    $fp=pfsockopen("192.168.1.201", 9100); //105
    fputs($fp, $data);
    fclose($fp);

    echo 'Successfully Printed';
}
catch (Exception $e) 
{
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
*/
/*
$site="192.168.1.105"; $port=9100;
$fp = @fsockopen($site,$port,$errno,$errstr,10);
if ($fp === false) { 
 print($errno." : ".$errstr); 
}  
if(!$fp)
{
echo "SERVER IS DOWN";
}
else
{
   	$data= "Hello";
    fputs($fp, $data);
echo "SERVER IS UP ON PORT ".$port." AT ".$site;
fclose($fp);
}*/

});

Route::group(['prefix'=>'admin','middleware'=>['auth']],function () {
    Route::get('/usercreate', 'Auth\RegisterController@showRegistrationForm')->name('usercreate');
    Route::post('/usercreate', 'Auth\RegisterController@register');
    Route::get('/changePassword','Auth\ChangePasswordController@index')->name('password.changee');
    Route::post('/changePassword','Auth\ChangePasswordController@changePassword')->name('password.updatee');
});

Route::group(['prefix'=>'control','middleware'=>['auth']],function () { 
	Route::resource('control','control1Controller');
	Route::post('reportpost','control1Controller@reportpost')->name('reportpost');

	Route::get('control2','control1Controller@control2')->name('control2');
	Route::post('reportpost2','control1Controller@reportpost2')->name('reportpost2');
});

Route::group(['prefix'=>'departman','middleware'=>['auth']],function () { 
	Route::resource('departman','departmanController');
	Route::get('/search',['uses' => 'departmanController@search','as' => 'sdepartman']);
});
Route::group(['prefix'=>'makinacins','middleware'=>['auth']],function () { 
	Route::resource('makinacins','definition\makinacinsController');
	Route::get('/search',['uses' => 'definition\makinacinsController@search','as' => 'smakinacins']);
});
Route::group(['prefix'=>'kenartipi','middleware'=>['auth']],function () { 
	Route::resource('kenartipi','definition\kenartipiController');
	Route::get('/search',['uses' => 'definition\kenartipiController@search','as' => 'skenartipi']);
});
Route::group(['prefix'=>'iplikcins','middleware'=>['auth']],function () { 
	Route::resource('iplikcins','definition\iplikcinsController');
	Route::get('/search',['uses' => 'definition\iplikcinsController@search','as' => 'siplikcins']);
});
Route::group(['prefix'=>'boyacins','middleware'=>['auth']],function () { 
	Route::resource('boyacins','definition\boyacinsController');
	Route::get('/search',['uses' => 'definition\boyacinsController@search','as' => 'sboyacins']);
});
Route::group(['prefix'=>'kalitedetay','middleware'=>['auth']],function () { 
	Route::resource('kalitedetay','definition\kalitedetayController');
	Route::get('/search',['uses' => 'definition\kalitedetayController@search','as' => 'skalitedetay']);
});
Route::group(['prefix'=>'hatalist','middleware'=>['auth']],function () { 
	Route::resource('hatalist','definition\hatalistController');
	Route::get('/search',['uses' => 'definition\hatalistController@search','as' => 'shatalist']);
});
Route::group(['prefix'=>'firmatipi','middleware'=>['auth']],function () { 
	Route::resource('firmatipi','definition\firmatipiController');
	Route::get('/search',['uses' => 'definition\firmatipiController@search','as' => 'sfirmatipi']);
});
Route::group(['prefix'=>'sipsozmad','middleware'=>['auth']],function () { 
	Route::resource('sipsozmad','definition\sipsozmadController');
	Route::get('/search',['uses' => 'definition\sipsozmadController@search','as' => 'ssipsozmad']);
});
Route::group(['prefix'=>'ebatcins','middleware'=>['auth']],function () { 
	Route::resource('ebatcins','definition\ebatcinsController');
	Route::get('/search',['uses' => 'definition\ebatcinsController@search','as' => 'sebatcins']);
});
Route::group(['prefix'=>'surecislemi','middleware'=>['auth']],function () { 
	Route::resource('surecislemi','definition\surecislemiController');
	Route::get('/search',['uses' => 'definition\surecislemiController@search','as' => 'ssurecislemi']);
});
Route::group(['prefix'=>'terbiyesureci','middleware'=>['auth']],function () { 
	Route::resource('terbiyesureci','definition\terbiyesureciController');
	Route::get('/search',['uses' => 'definition\terbiyesureciController@search','as' => 'sterbiyesureci']);
});
Route::group(['prefix'=>'gorevlistesi','middleware'=>['auth']],function () { 
	Route::resource('gorevlistesi','definition\gorevlistesiController');
	Route::get('/search',['uses' => 'definition\gorevlistesiController@search','as' => 'sgorevlistesi']);
});
Route::group(['prefix'=>'personel','middleware'=>['auth']],function(){
	Route::resource('personel','definition\personelController');
	Route::get('/search',['uses' => 'definition\personelController@search','as' => 'spersonel']);
	Route::get('/{list}',['uses'=>'definition\personelController@list','as'=>'listpersonel']);
	Route::get('perkotek/{id}',['uses'=>'control1Controller@show','as'=>'perkotek']);
});
Route::group(['prefix'=>'firma','middleware'=>['auth']],function(){
	Route::resource('firma','definition\firmaController');
	Route::get('/search',['uses' => 'definition\firmaController@search','as' => 'sfirma']);
});
Route::group(['prefix'=>'tesis','middleware'=>['auth']],function(){
	Route::resource('tesis','definition\tesisController');
	Route::get('/search',['uses' => 'definition\tesisController@search','as' => 'stesis']);
});
Route::group(['prefix'=>'yetkili','middleware'=>['auth']],function(){
	Route::resource('yetkili','definition\yetkiliController');
	Route::get('/search',['uses' => 'definition\yetkiliController@search','as' => 'syetkili']);
});
Route::group(['prefix'=>'desen','middleware'=>['auth']],function(){
	Route::resource('desen','definition\desenController');
	Route::get('/search',['uses' => 'definition\desenController@search','as' => 'sdesen']);
	Route::get('create','definition\desenController@js')->name('js');
	Route::get('images/{id}','definition\desenController@images')->name('imagesd');

	Route::get('{id}', 'definition\patterndetailController@create');
	Route::get('patternwarp/{id}', 'definition\patterndetailController@patternwarpCreate');
	Route::get('patternwarp/js/{id}/{iplik}', 'definition\patterndetailController@patternwarpJs');
	Route::post('patternwarp/store', 'definition\patterndetailController@patternwarpStore')->name('patternwarpStore');
	Route::post('patternwarp/update', 'definition\patterndetailController@patternwarpUpdate')->name('patternwarpUpdate');
	Route::delete('patternwarp/destroy/{id}','definition\patterndetailController@destroy2')->name('patternwarpdelete');

	Route::post('sortable','definition\patterndetailController@sortable')->name('patternwarpSortable');

	Route::get('imagedestroy/{id}/{no}','definition\desenController@imagedestroy')->name('desenimagedestroy');
	Route::get('report/{id}','definition\desenController@report')->name('desen.report');
	Route::get('show2/{id}','definition\desenController@show2')->name('show2');
});
Route::group(['prefix'=>'patterndetail','middleware'=>['auth']],function(){
	Route::resource('patterndetail','definition\patterndetailController');
	Route::get('{id}', 'definition\patterndetailController@copy');
});
Route::group(['prefix'=>'order','middleware'=>['auth']],function(){
	Route::resource('order','definition\orderController');
	Route::get('create','definition\orderController@js')->name('ojs');
	Route::get('kapanan','definition\orderController@kjs')->name('kjs');
	Route::get('kapananindex','definition\orderController@kapananindex')->name('kapananindex');
	Route::get('takipform/{id}','definition\orderController@takipform')->name('takipform');
	Route::post('machine/plan','definition\orderController@machine')->name('machine');

	Route::post('Sortable','definition\orderController@sortable')->name('show.Sortable');
	Route::post('Sortable2','definition\orderController@sortable2')->name('show.Sortable2');

	Route::get('report/{id}','definition\orderController@report')->name('show.report');
	
	Route::get('{id}','definition\orderController@show2');
	Route::get('orderno/{id}','definition\orderController@orderno')->name('orderno');
	Route::get('imagedestroy/{id}/{no}','definition\orderController@imagedestroy')->name('orderimagedestroy');
	Route::get('images/{id}','definition\orderController@images')->name('images');
	Route::get('/price/js','definition\orderController@pricejs')->name('pricejs');
	Route::get('/price/index','definition\orderController@priceindex')->name('priceindex');
});
Route::group(['prefix'=>'isemri','middleware'=>['auth']],function(){
	Route::resource('isemri','isemriController');
	Route::get('create','isemriController@js')->name('ijs');
	Route::get('{id}','isemriController@create');
});
Route::group(['prefix'=>'kkform','middleware'=>['auth']],function(){
	Route::resource('kkform','kkformController');
	Route::get('create','kkformController@js')->name('kkformjs');
	Route::post('create1','kkformController@create1')->name('kkformcreate1');
	Route::get('as','kkformController@as');

	Route::get('kkformtop','kkformController@kkformtop')->name('kkformtop');
	Route::get('kabul/{id}','kkformController@kabul')->name('kabul');
	Route::get('sticker/{id}','kkformController@sticker')->name('sticker');
	Route::post('kkformlist','kkformController@kkformlist')->name('kkformlist');
	Route::delete('kkformdetaildestroy/{id}','kkformController@kkformdetaildestroy')->name('kkformdetaildestroy');
	Route::post('topbolme','kkformController@topbolme')->name('topbolme');

	Route::get('ballsticker/{id}','kkformController@ballsticker');
	Route::get('ball/{id}','kkformController@balledit');
	Route::post('ballupdate','kkformController@ballupdate')->name('ballupdate');
	Route::delete('delete/{id}','kkformController@destroy2');

	
	Route::post('iskarta','kkformController@iskarta')->name('iskarta');
	Route::get('ball_list','kkformController@ball_list')->name('ball_list');
	Route::get('ball_list/create','kkformController@ball_list_js')->name('ball_list_js');

	Route::get('shipball_list','kkformController@shipball_list')->name('shipball_list');
	Route::get('shipball/create','kkformController@shipball_js')->name('shipball_js');

	Route::get('ballerror/{id}','kkformController@ballerror')->name('ballerror');
	Route::get('orderball/{id}','kkformController@orderball')->name('orderball');

	Route::get('uretilentop_list','kkformController@uretilentop_list')->name('uretilentop_list');
	Route::get('uretilentop_list/create','kkformController@uretilentop_list_js')->name('uretilentop_list_js');

});
Route::group(['prefix'=>'mamulkkform','middleware'=>['auth']],function(){
	Route::resource('mamulkkform','mamulkkformController');
	Route::get('create','mamulkkformController@js')->name('mamulkkformjs');
});
Route::group(['prefix'=>'sevkham','middleware'=>['auth']],function(){
	Route::resource('sevkham','sevkhamController');
	Route::get('create','sevkhamController@js')->name('sevkhamjs');
	Route::get('firmadetay/{id}','sevkhamController@fdetay')->name('fdetay');
	Route::post('sevkhamdetay','sevkhamController@store2')->name('sevkhamdetay');
	Route::get('sevkhamdetay/{id}','sevkhamController@sevkdetay')->name('sevkhamdetay2');
	Route::delete('sevkhamdetaysil/{id}','sevkhamController@destroy2')->name('detaildelete');
	Route::get('report/{id}','sevkhamController@report');
});

Route::group(['prefix'=>'sevkmamul','middleware'=>['auth']],function(){
	Route::resource('sevkmamul','sevkmamulController');
	Route::get('create','sevkmamulController@js')->name('sevkmamuljs');
	Route::get('firmadetay/{id}','sevkmamulController@fdetay')->name('fdetay');
	Route::post('sevkmamuldetay','sevkmamulController@store2')->name('sevkmamuldetay');
	Route::get('sevkmamuldetay/{id}','sevkmamulController@sevkdetay')->name('sevkmamuldetay2');
	Route::delete('sevkmamuldetaysil/{id}','sevkmamulController@destroy2')->name('mamuldetaildelete');
	Route::get('report/{id}','sevkmamulController@report');
});
Route::group(['prefix'=>'instructions','middleware'=>['auth']],function(){
	Route::get('{id}', 'instructionsController@create')->name('instructions.create');
	Route::post('instructions/instructions', 'instructionsController@store')->name('instructions.store');
});
Route::group(['prefix'=>'iplikhareket','middleware'=>['auth']],function(){
	Route::resource('iplikhareket','iplikhareketController');
	//Route::get('create','iplikhareketController@js')->name('iplikjs');
	Route::get('etiket/{id}','iplikhareketController@etiket')->name('etiket');
});
Route::group(['prefix'=>'iplikirsaliye','middleware'=>['auth']],function(){
	Route::resource('iplikirsaliye','iplikirsaliyeController');
	Route::get('create','iplikirsaliyeController@js')->name('iplikirsaliyejs');
	Route::any('iplikirsaliyesearch','iplikirsaliyeController@iplikirsaliyesearch')->name('iplikirsaliyesearch');

	//Yarn O
	Route::post('iplikgirisdetail','iplikirsaliyeController@iplikgirisdetail')->name('iplikgirisdetail');
	Route::get('iplikgiris/{id}','iplikirsaliyeController@iplikgiris')->name('iplikgiris');
	Route::get('etiket/{id}','iplikirsaliyeController@etiket')->name('etiket');
	Route::get('topluetiket/{id}','iplikirsaliyeController@topluetiket')->name('topluetiket');
	//yarn C 
	Route::post('storedetail/store','iplikirsaliyeController@storedetail')->name('iplikirsaliyestoredetail');
	Route::get('showdetail/{id}','iplikirsaliyeController@showdetail')->name('iplikcikis');
	Route::delete('iplikirsaliyedetaildestroy/{id}','iplikirsaliyeController@iplikirsaliyedetaildestroy')->name('iplikirsaliyedetaildestroy');
	//bölme
	Route::post('cuvalbol','iplikirsaliyeController@cuvalbol')->name('cuvalbol');
	Route::get('cuvalboletiket/{id}','iplikirsaliyeController@cuvalboletiket')->name('cuvalboletiket');
	//report
	Route::get('report','iplikirsaliyeController@showreport')->name('iplikreport');
	Route::get('create2','iplikirsaliyeController@showjs')->name('iplikjs');
	Route::get('report2','iplikirsaliyeController@showreport2')->name('iplikreport2');
	Route::get('createreport2','iplikirsaliyeController@showjs2')->name('iplikjs2');
	Route::get('show2/{id}','iplikirsaliyeController@show2')->name('iplikshow2');

	Route::get('showreport3/{iplikno}/{ne}/{iplikcins}/{partino}/{renkno}','iplikirsaliyeController@showreport3')->name('showreport3');

});
Route::group(['prefix'=>'leventhareket','middleware'=>['auth']],function(){
	Route::resource('leventhareket','leventhareketController');
	Route::get('create','leventhareketController@js')->name('leventirsaliyejs');
	Route::get('leventdepo','leventhareketController@leventdepo')->name('leventdepo');
	Route::get('create2','leventhareketController@leventdepojs')->name('leventdepojs');

	Route::get('levent/{id}','leventhareketController@leventdepoedit');
	Route::post('leventdepostore','leventhareketController@leventdepostore')->name('leventdepostore');

	//LE O
	Route::get('/giris/{id}','leventhareketController@leventgiris')->name('leventgiris');
	Route::post('leventgirisdetail','leventhareketController@leventgirisdetail')->name('leventgirisdetail');
	//LE C
	Route::get('girisetiket/{id}','leventhareketController@girisetiket')->name('leventgirisetiket');
	Route::get('toplugirisetiket/{id}','leventhareketController@toplugirisetiket')->name('leventtoplugirisetiket');
	
	Route::get('cikis/{id}','leventhareketController@leventcikis')->name('leventcikis');
	Route::post('leventcikisdetail','leventhareketController@leventcikisdetail')->name('leventcikisdetail');
	Route::delete('leventcikisdestroy/{id}','leventhareketController@leventcikisdestroy')->name('leventcikisdestroy');

	Route::get('show2/{id}','leventhareketController@show2')->name('leventshow2');
	Route::get('show3/{id}','leventhareketController@show3')->name('leventshow3');
	
});
Route::group(['prefix'=>'iplikbukum','middleware'=>['auth']],function(){
	Route::resource('iplikbukum', 'iplikbukumController');
	Route::get('create','iplikbukumController@js')->name('bukumjs');
	Route::get('create2/{id}','iplikbukumController@create2')->name('bukumcreate2');
	Route::post('store2','iplikbukumController@store2')->name('bukumstore2');
	Route::delete('destroy2/{id}','iplikbukumController@destroy2')->name('bukumdestroy2');
});
Route::group(['prefix'=>'iplikboya','middleware'=>['auth']],function(){
	Route::resource('iplikboya', 'iplikboyaController');
	Route::get('create','iplikboyaController@js')->name('boyajs');
	Route::get('create2/{id}','iplikboyaController@create2')->name('boyacreate2');
	Route::post('store2','iplikboyaController@store2')->name('boyastore2');
	Route::delete('destroy2/{id}','iplikboyaController@destroy2')->name('boyadestroy2');
});
Route::group(['prefix'=>'cozgu','middleware'=>['auth']],function(){
	Route::resource('cozgu', 'cozguController');
	Route::get('create','cozguController@js')->name('cozgujs');
	Route::get('cozgubilgi/{id}','cozguController@cozgubilgi')->name('cozgubilgi');
});
Route::group(['prefix'=>'uretimtakip','middleware'=>['auth']],function(){
	Route::resource('uretimtakip', 'uretimtakipController');
	Route::get('create1/{id}','uretimtakipController@create1')->name('create1');
	Route::post('stop', 'uretimtakipController@stop')->name('stop');
	//Route::get('create','cozguController@js')->name('cozgujs');
	Route::get('machinebarcode', 'uretimtakipController@machinebarcode')->name('machinebarcode');
	Route::post('topkes', 'uretimtakipController@topkes')->name('topkes');


});

Route::group(['prefix'=>'boyahane','middleware'=>['auth']],function(){
	Route::resource('boyahane', 'boyahaneController');
	Route::get('create','boyahaneController@js')->name('boyahanejs');
	Route::get('create2/{id}','boyahaneController@create2')->name('boyahanecreate2');
	Route::post('store2','boyahaneController@store2')->name('boyahanestore2');
	Route::get('edit2/{id}','boyahaneController@edit2')->name('boyahaneedit2');
	Route::post('update2','boyahaneController@update2')->name('boyahaneupdate2');
	Route::delete('destroy2/{id}','boyahaneController@destroy2')->name('boyahanedestroy2');

	Route::get('order/{id}','boyahaneController@order');
});

Route::group(['prefix'=>'kumas','middleware'=>['auth']],function(){
	Route::resource('kumas', 'kumasController');
	Route::get('create','kumasController@js')->name('kumasjs');
	Route::get('create2/{id}','kumasController@create2')->name('kumascreate2');
	Route::post('store2','kumasController@store2')->name('kumasstore2');
	// Route::delete('destroy2/{id}','kumasController@destroy2')->name('kumasdestroy2');
	Route::get('sticker/{id}','kumasController@sticker')->name('kumassticker');

});
Route::group(['prefix'=>'ball','middleware'=>['auth']],function(){
	Route::get('demandindex','ballController@demandindex')->name('demandindex');
	Route::get('transferdetail/{id}','ballController@transferdetail')->name('transferdetail');
	Route::get('split','ballController@split')->name('split');
	Route::get('transfer','ballController@transfer')->name('transfer');
	Route::post('splitstore', 'ballController@splitstore')->name('splitstore');
	Route::post('demandstore', 'ballController@demandstore')->name('demandstore');
	Route::post('transferstore', 'ballController@transferstore')->name('transferstore');
});