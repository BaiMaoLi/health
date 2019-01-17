<?php


use App\Model\admin\Event;
use Illuminate\Support\Facades\Mail;



Route::get('/', function () {
    if(!Auth::check()){
        $events=Event::where('category_name','Public')->get();
        return view('home',compact('events'));
    }
    else{
        return redirect('/home');
    }

});

Route::get('/login', function () {
    $events=Event::where('category_name','Public')->get();
    return view('login_fail',compact('events'));
});





Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/home1',function(){
//    return view('home1');
//});


//Admin Routes
Route::group(['namespace' => 'User'],function(){

    Route::get('/template','UserController@template');

    Route::get('/home','UserController@logged');

    Route::get('/heart','UserController@heart');

    Route::get('/single_event/{id}','UserController@single_event')->name('single_event');

    Route::get('/alerts','UserController@all_alert');

    Route::get('/calendar','UserController@calendar');

    Route::get('/calendar/{month}','UserController@calendar_month');

    Route::get('/calendar/{month}','UserController@calendar_month');

    Route::get('/health-forms','UserController@document');


    Route::Resource('/profile','UserProfileController');

    Route::get('/event_confirm/{id}','UserController@single_event_confirmation')->name('event_confirm');

    Route::get('single_event/register/{id}','UserController@register_event');
    Route::get('event_confirm/unregister/{id}','UserController@unregister_event');

    Route::post('/get_event_date','UserController@get_event_date');

    Route::get('notifications', 'UserController@notifications');

    Route::get('/get_single_event','UserController@get_single_event'); //Getting Single Event when click event date in calendar page

    Route::get('/get_all_event','UserController@get_all_event'); //Getting Single Event when click event date in calendar page

    Route::get('get_single_notification/{id}','UserController@single_notification');

    Route::post('notyRead','UserController@notyRead');

    Route::post('notyRemove','UserController@notyRemove');

    Route::get('notyRemoveAll','UserController@notyRemoveAll');

    Route::get('getMonthEvents','UserController@getMonthEvents');

    Route::get('/download/{id}','UserController@downloadFile');

});






//Admin Routes
Route::group(['namespace' => 'Admin'],function(){
    Route::post('/admin-create','AdminController@create_admin');
    Route::get('/admin-create',function(){
        return view('admin.create');
    });


//    Route::get('/admin-login','Auth\LoginController@showLoginForm')->name('admin.login');

    Route::get('/admin-login','Auth\LoginController@showLoginForm');

    Route::get('/admin-logout','Auth\LoginController@logout')->name('admin.logout');

    Route::resource('admin/user','UserController');

    Route::get('admin/printall','UserController@printAll')->name('admin.user.printall');

    Route::get('admin/print/{id}','UserController@printUser')->name('admin.user.print');

    Route::get('admin/download_excel','UserController@downloadExcel')->name('admin.user.download');


    Route::resource('/admin/category','CategoryController');

    Route::resource('/admin/tag','TagController');

    Route::resource('/admin/event','EventController');

    Route::get('/admin/event/edit_alert/{event_id}','EventController@edit_alert')->name('event.editAlert');
    Route::post('/admin/event/send_alert/{event_id}','EventController@send_alert')->name('event.sendAlert');


    Route::resource('/admin/health-forms','DocumentController');


    Route::resource('/admin/task','TaskController');
    Route::get('/admin/task/unregstered_user/{id}','TaskController@showUnregsters')->name('task.showUnregsters');
    Route::get('/admin/task/makeIncomplete/{user_id}/{task_id}',['as'=>'makeIncomplete','uses'=>'TaskController@makeIncomplete']);
    Route::get('/admin/task/makeComplete/{user_id}/{task_id}',['as'=>'makeComplete','uses'=>'TaskController@makeComplete']);
    Route::get('/admin/task/makeAmbassador/{user_id}/{task_id}',['as'=>'makeAmbassador','uses'=>'TaskController@makeAmbassador']);
    Route::get('/admin/task/removeAmbassador/{user_id}/{task_id}',['as'=>'removeAmbassador','uses'=>'TaskController@removeAmbassador']);
    Route::get('/admin/task/edit_alert/{task_id}','TaskController@edit_alert')->name('task.editAlert');
    Route::post('/admin/task/send_alert/{task_id}','TaskController@send_alert')->name('task.sendAlert');

    Route::get('/admin/task/complete_user/edit/alert/{task_id}','TaskController@edit_alertComplete')->name('task.editAlertComplete');
    Route::post('/admin/task/send_alert_complete_users/{task_id}','TaskController@send_alertComplete')->name('task.sendAlertCompleteUsers');


    Route::get('/admin/user/tasks/{id}','UserController@showTasks')->name('user.tasks');
    Route::post('/admin-login','Auth\LoginController@login')->name('admin.login');;
    Route::get('/admin/home', function(){
        return view('admin.home');
    })->middleware('auth:admin');


    Route::get('/admin-register',function(){
        return view('admin.create');
    });


    Route::get('/admin/alert_page','AlertController@home')->name('alert');;
    Route::post('/admin/edit_alert','AlertController@edit_alert');
    Route::post('/admin/send_alert','AlertController@send_alert');

    Route::get('/admin/email_page','EmailController@home')->name('email');;
    Route::post('/admin/edit_email','EmailController@edit_email');
    Route::post('/admin/send_email','EmailController@send_email');



    Route::get('/admin/IndividualTask/SelectUser','IndividualTaskController@SelectUser');
    Route::get('/admin/IndividualTask/show','IndividualTaskController@show')->name('IndividualTask');
    Route::post('/admin/IndividualTask/create','IndividualTaskController@create');
    Route::post('/admin/IndividualTask/store','IndividualTaskController@store');
    Route::get('/admin/IndividualTask/edit/{id}','IndividualTaskController@edit')->name('IndividualTaskEdit');
    Route::post('/admin/IndividualTask/update/{id}','IndividualTaskController@update')->name('IndividualTaskUpdate');
    Route::post('/admin/IndividualTask/destroy/{id}','IndividualTaskController@destroy')->name('IndividualTaskDestroy');
    Route::get('/admin/IndividualTask/completeUser/{id}','IndividualTaskController@ShowCompleteUsers')->name('IndividualTaskCompleteUser');
    Route::get('/admin/IndividualTask/IncompleteUser/{id}','IndividualTaskController@ShowIncompleteUsers')->name('IndividualTaskIncompleteUser');
    Route::get('/admin/IndividualTask/markIncompleteIndividualTask/{user_id}/{task_id}',['as'=>'markIncompleteIndividualTask','uses'=>'IndividualTaskController@markIncomplete']);
    Route::get('/admin/IndividualTask/markCompleteIndividualTask/{user_id}/{task_id}',['as'=>'markCompleteIndividualTask','uses'=>'IndividualTaskController@markComplete']);


    Route::get('/admin/IndividualTask/edit_alert/{task_id}','IndividualTaskController@edit_alert');
    Route::post('/admin/IndividualTask/send_alert/{task_id}','IndividualTaskController@send_alert')->name('IndividualTask.sendAlert');

    Route::get('/admin/IndividualTask/complete_user/edit_alert/{task_id}','IndividualTaskController@edit_alertComplete');
    Route::post('/admin/IndividualTask/send_alertComplete/{task_id}','IndividualTaskController@send_alertComplete')->name('IndividualTask.sendAlertComplete');


});








//Route::get('send_test_email','TestController@sendMail');
//
//
//Route::get('send_test_email', function(){
//
//    $to = "baimaoli9@gmail.com";
//    $subject = "My subject";
//    $txt = "Hello world!";
//    $headers = "From: postmaster@myptihealth.com" . "\r\n" ;
//
//    mail($to,$subject,$txt,$headers);
//
//});
//
//
//
//
//
//





//
//
//Route::get('send_test_email', function(){
//    \Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
//    {
//        $message->subject('Mailgun and Laravel are awesome!');
////        $message->from('no-reply@website_name.com', 'Website Name');
////        $message->from('no-reply@website_name.com');
//        $message->to('baimaoli9@gmail.com');
//    });

//dd(Mail::failures());
//});
//

//
//
//
//
//

Route::get('send-mail','TestController@simplemail');

Route::get('send_test_email', function() {
    Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message) {
        $message->from('postmaster@myptihealth.com', 'My name');
        $message->subject('subject');

        $message->to('baimaoli9@gmail.com');
        echo "<pre>";
        print_r($message);exit;
    });
});




