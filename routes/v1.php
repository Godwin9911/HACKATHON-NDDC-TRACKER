<?php


//Authentication Routes ******************************************************

//Registration
Route::post('register', 'Auth\RegisterController@community_member'); //has a role 4

//Login
Route::post('login', 'Auth\LoginController@authenticate'); //

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



Route::get('/excel', 'importExcelController@indexAsJson');
Route::get('downloadData/{type}', 'importExcelController@downloadData');
Route::post('importExcel', 'importExcelController@importExcel');


//Admin Routes (Specific Route)*******************************************************

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('user/all', 'UserProfileController@all')->middleware('admin');

});




// General Users Routes *******************************************************
Route::group(['middleware' => ['jwt.verify']], function () {
    //Refresh token
    Route::post('/refresh', 'Auth\LoginController@refresh');

    //(User Profile)

    //Show active user i.e. current logged in user
    Route::get('/user', 'UserProfileController@index');

    //show one user
    Route::get('/user/{id}', 'UserProfileController@show');

    //Edit user ac count
    Route::post('/user/edit', 'UserProfileController@update');

    //Delete user account
    Route::delete('/user/delete', 'UserProfileController@destroy');

    
});
