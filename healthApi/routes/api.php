<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::group([
//    'prefix' => 'auth'
//], function () {
//    Route::post('login', 'AuthController@login');
//    Route::post('signup', 'AuthController@signup');
//
//    Route::group([
//        'middleware' => 'auth:api'
//    ], function() {
//        Route::get('logout', 'AuthController@logout');
//        Route::get('user', 'AuthController@user');
//    });
//});


Route::post('loginRequest', 'UserController@login');
Route::post('registerRequest', 'UserController@register');

Route::post('insert_query_category','QueryController@insertQueryCategory');
Route::get('query_category','QueryController@getQueryCategory');

Route::post('insert_scoreInterp','QueryController@insertScoreInterp');

Route::post('query','QueryController@getQuery');
Route::post('insertQuery','QueryController@insertQuery');

Route::post('saveQueryResult','QueryController@saveQueryResult');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'UserController@details');
    Route::post('saveQueryResult','QueryController@saveQueryResult');

});


//eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE1OGUwNzY5YWMyMzgyNzQ3NTQ4MGIzODIzZGY1ZDk5MTczNTUzNzNmZWY0NmU2OGRiZWRkMDg1OGI1ODYzNTJiOTQxMGJmNjgxOWNiNTBhIn0.eyJhdWQiOiIzIiwianRpIjoiYTU4ZTA3NjlhYzIzODI3NDc1NDgwYjM4MjNkZjVkOTkxNzM1NTM3M2ZlZjQ2ZTY4ZGJlZGQwODU4YjU4NjM1MmI5NDEwYmY2ODE5Y2I1MGEiLCJpYXQiOjE1MzQ5MDc2ODIsIm5iZiI6MTUzNDkwNzY4MiwiZXhwIjoxNTY2NDQzNjgyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.gq3iiV2Ko_7Iwl89cR9vRuuoZGeA7R2zRrCJKaHkhhxKFmkIVkH6hoZLIIMkV8LC9oAMU00y93-TA85j68oKVXIXbNcwQYkw70mIiTh-ijBNscS3NhCKI9LCHs94mSIkFEaGv_UJZc8vinu_iuqSYyAWexbq_bg_EuE7h_MWo_lETBpR2r9h7PcpADaxth5QsNgNUcAu_sXcgYOOHf62s3pjsT49Xq70LUuPjeNrk7iTrFeV9PxKS8IPhCFUTFlT-BYJWT5Jqj5V5uhHytSMIkHe8kP6u3xYvB3QOT3nNrbAru1eA8Qq-jrEuQCb9PO2AlzqWEoDAY2GfVgcONrzxvdIZTYeIZqqS31aIc12cYpshRxIfOyixE545uLFnae1mpbui6lBEiMNhDejIftgVwgkOQIUDycUZ05UtDNCk7KE9Fg-JOD6vyfloHEDO8afAZIY6gRV1taFAbF04Btx7yZV5Z5IerNwt8ucCw6mVXzYlCJTehLh0PfZSn4kQBgo1FFrNaOJ8wrbMuiq-YpPF2H4r3m9-4kOL0-QPjHsKbnNd_s4WvJkgTHUwgNDMedJ_FPFUZOpfY_tiLi8bNyZynyog84uigrT9fhEyXMQY5aKqgTPR5KBVqLTuD229TFf-mm6V17CPpg66o4zGHogjVcHV6AOcP7bQrXsEQqhWQ0