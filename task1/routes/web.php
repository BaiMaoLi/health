<?php

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
    return view('homepage');
});

Auth::routes();

Route::get('/', 'HomeController@homepage')->name('homepage');
Route::get('/homepage', 'HomeController@homepage')->name('homepage');
Route::get('/page1', 'HomeController@page1')->name('page1');

Route::group(['middleware' => 'auth'], function () {
  //  Route::get('/page1', 'HomeController@page1')->name('page1');
    Route::get('/page2', 'HomeController@page_2')->name('page2');
    Route::get('/page3', 'HomeController@page3')->name('page3');
    Route::get('/page4', 'HomeController@page4')->name('page4');
    Route::get('/page5', 'HomeController@page5')->name('page5');
    Route::get('/page6', 'HomeController@page6')->name('page6');
    Route::get('/page7', 'HomeController@page7')->name('page7');
    Route::post('/addCategory', 'CartegoryController@addCategory');
    Route::post('/addrecorder', 'RecorderController@addrecorder');
    Route::post('/addCategory2', 'CartegoryController@addcategory2');
    Route::post('/addCategory3', 'CartegoryController@addcategory3');
    Route::post('/addrecorder', 'RecorderController@addrecorder');
    Route::post('/addCategory0', 'CartegoryController@addCategory0');
    Route::post('/address', 'CartegoryController@address');
    Route::post('/address1', 'CartegoryController@address1');
    Route::post('/SendMail', 'SendMailController@sendemail');


});
Route::post('/ajax', 'RecorderController@ajaxUpdate');




