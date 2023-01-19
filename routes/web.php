<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/setup',function(){

    $creds = [
        'email' => 'admin@admin.com',
        'password' => '12345'
    ];

    if(!Auth::attempt($creds)){
      $user = new App\Models\User();

      $user->f_name = 'Admin';
      $user->l_name = 'admin';
      $user->phone = '00999' ;
      $user->email = 'admin@admin.com' ;
      $user->ref_times = 4 ;
      $user->ref_code =  Str::random(10);
      $user->remember_token = Str::random(10);


      $user->password = Hash::make($creds['password']) ;

      $user->save();

      echo '1';
      if(Auth::attempt($creds)){
        echo '2';

        $user = Auth::user();

        $adminToken = $user->createToken('admin-token', ['create', 'update', 'delete']);
        $updateToken = $user->createToken('update-token', ['create', 'update']);
        $basicToken = $user->createToken('basic-token');


        return [
            'admin'=> $adminToken->plainTextToken
        ];
      }
    }


});
