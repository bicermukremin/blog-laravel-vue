<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Auth::routes();
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/{any?}', function ($any=null) {
    if($any==null && $any!='madmin'&& $any!='signin' && $any!='signup'){

        return view('home');

    }else if($any=='signin'){
        
        return view('admin');

    }else if($any=='signup'){
        
        return view('admin');
    }else if($any=='madmin'){
        
        return view('admin');
    }else{
       return view('home'); 
    }
})->where('any', '^(?!api\/)[\/\w\.-]*')
->where('any', '^(?!madmin\/)[\/\w\.-]*')
->where('any', '^(?!signin\/)[\/\w\.-]*')
->where('any', '^(?!signup\/)[\/\w\.-]*');