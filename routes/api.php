<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('/services', App\Http\Controllers\Api\ServiceController::class)->except('index','update');
Route::post('/services/{service}', [App\Http\Controllers\Api\ServiceController::class,'serviceUpdate']);
Route::get('/services', [App\Http\Controllers\Api\ServiceController::class,'index']);

/* Route::apiResource('/blogs', App\Http\Controllers\Api\BlogController::class)->except('index','update'); */
Route::post('/blogs/{blog}', [App\Http\Controllers\Api\BlogController::class,'blogUpdate']);
Route::get('/blogs', [App\Http\Controllers\Api\BlogController::class,'index']);

Route::apiResource('/sliders', App\Http\Controllers\Api\SliderController::class)->except('index','update');
Route::post('/sliders/{slider}', [App\Http\Controllers\Api\SliderController::class,'sliderUpdate']);
Route::get('/sliders', [App\Http\Controllers\Api\SliderController::class,'index']);

Route::apiResource('/banners', App\Http\Controllers\Api\BannerController::class)->except('index','update');
Route::post('/banners/{banner}', [App\Http\Controllers\Api\BannerController::class,'bannerUpdate']);
Route::get('/banners', [App\Http\Controllers\Api\BannerController::class,'index']);

Route::apiResource('/abones', App\Http\Controllers\Api\AboneController::class)->except('index','update');
Route::post('/abones/{abone}', [App\Http\Controllers\Api\AboneController::class,'aboneUpdate']);
Route::get('/abones', [App\Http\Controllers\Api\AboneController::class,'index']);
Route::post('/make-abone', [App\Http\Controllers\Api\AboneController::class,'makeAbone']);

Route::apiResource('/mails', App\Http\Controllers\Api\MailController::class)->except('index','update');
Route::post('/mails/{mail}', [App\Http\Controllers\Api\MailController::class,'mailUpdate']);
Route::get('/mails', [App\Http\Controllers\Api\MailController::class,'index']);
Route::post('/send-mail', [App\Http\Controllers\Api\MailController::class,'sendMail']);
Route::post('/make-comment', [App\Http\Controllers\Api\MailController::class,'makeComment']);


Route::apiResource('/projects', App\Http\Controllers\Api\ProjectController::class)->except('index','update');
Route::post('/projects/{project}', [App\Http\Controllers\Api\ProjectController::class,'projectUpdate']);
Route::get('/projects', [App\Http\Controllers\Api\ProjectController::class,'index']);


Route::post('/softResimSil', [App\Http\Controllers\Api\SoftwareController::class,'resmiSil']);
Route::post('/softResimSil', [App\Http\Controllers\Api\SoftwareController::class,'resmiSil']);
Route::apiResource('/yazilim', App\Http\Controllers\Api\YazilimController::class);


Route::post('/aboutResimSil/{about}', [App\Http\Controllers\Api\AboutController::class,'resmiSil']);
Route::post('/serviceResimSil/{service}', [App\Http\Controllers\Api\ServiceController::class,'serviceResmiSil']);
Route::post('/makeActive/{about}', [App\Http\Controllers\Api\AboutController::class,'makeActive']);
Route::apiResource('/about', App\Http\Controllers\Api\AboutController::class)->except('update','edit','show');
Route::get('/front-about', [App\Http\Controllers\Api\AboutController::class,'showFrontend']);
Route::get('/front-soft', [App\Http\Controllers\Api\YazilimController::class,'showSoftware']);

Route::apiResource('/categories', App\Http\Controllers\Api\CategoryController::class);
Route::apiResource('/comments', App\Http\Controllers\Api\CommentController::class);
Route::apiResource('/settings', App\Http\Controllers\Api\SettingController::class);

Route::apiResource('/replies', App\Http\Controllers\Api\ReplyController::class);
Route::post('/reply-reply', [App\Http\Controllers\Api\ReplyController::class,'replyReply']);