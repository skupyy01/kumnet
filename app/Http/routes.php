<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('mm', function (){
	
	$ssh = new \phpseclib\Net\SSH2('8.0.0.100');
    if (!$ssh->login('root', '123456')) {
         exit('Login Failed');
    }
 
     $a = $ssh->exec('dmesg | grep board=');
     $s = substr($a, strpos($a, '=')+1,15);
     echo 'Connected to '.$s;

     $ssh->exec('uci set wireless.guest.ssid=MMMMMM');
     $ssh->exec('uci commit');
     echo 'Set ssid success!.';
     
     
});
Route::get('/addap/{mac}/{ip}', 'AccesspointController@addap');

Route::get('/count/{user}', 'AccesspointController@countAp');

Route::auth();

Route::get('/home', 'HomeController@index');