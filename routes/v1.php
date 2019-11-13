<?php


//Authentication Routes ******************************************************

//Registration
Route::post('register', 'Auth\RegisterController@community_member'); //has a role 4

//Login
Route::post('login', 'Auth\LoginController@authenticate'); //

//Login
Route::post('admin/login', 'Auth\AdminLoginController@authenticate'); //

//forgot Password
Route::post('forgot/password', 'Auth\ForgotPasswordController@password');

//Verify account
Route::post('reset/password', 'Auth\ResetPasswordController@reset');

//Verify account
Route::post('verify', 'Auth\VerificationController@verify');

//Refresh JWT Token
Route::get('refresh/token', 'Auth\LoginController@refresh');
//Resend Token
// Route::get('resend/token', 'Auth\VerificationController@reset');
//Create Project
Route::get('project/search/{query}', 'ProjectController@search');


Route::get('/excel', 'importExcelController@indexAsJson');
Route::get('downloadData/{type}', 'importExcelController@downloadData');
Route::post('subscriber/create', ' SubscriberController@send');


//Admin Routes (Specific Route)*******************************************************

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('user/all', 'UserProfileController@all')->middleware('admin');
    Route::get('count', 'Statistics\CountStatsController@index')->middleware('admin');

});
//Project with admin
Route::group(['middleware' => ['jwt.verify']], function () {
    //All PROJECT
    Route::get('projects', 'ProjectController@index')->middleware('admin');
    //Import the Project Spreadsheet
    Route::post('import/project', 'ImportExcelController@importExcel')->middleware('admin');
    //Create Project
    Route::post('project/create', 'ProjectController@store')->middleware('admin');

      //Subscribe
    Route::get('subscribers', ' SubscriberController@index')->middleware('admin');
    Route::get('subscriber/one/{id}', ' SubscriberController@show')->middleware('admin');
    Route::post('subscriber/delete/{id}', ' SubscriberController@destroy')->middleware('admin');
   
   

});




// General Users Routes *******************************************************
Route::group(['middleware' => ['jwt.verify']], function () {
    //Refresh token
    Route::post('/refresh', 'Auth\LoginController@refresh');

    //(User Profile)

    //Show active user i.e. current logged in user
    Route::get('/user', 'UserProfileController@index');

    //show one user
    Route::get('/user/{id}', 'UserProfileController@showOne');

    //Edit user ac count
    Route::post('/user/edit', 'UserProfileController@update');

    //Delete user account
    Route::put('/password/change', 'UserProfileController@updatePassword');

    //Delete user account
    Route::delete('/user/delete', 'UserProfileController@destroy');

     //Setting
     Route::post('/setting', 'UserProfileController@setting');

});

//Project with User
Route::group(['middleware' => ['jwt.verify']], function () {


});
