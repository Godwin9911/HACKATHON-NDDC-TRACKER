<?php


//Authentication Routes ******************************************************

//Registration
Route::post('register/admin', 'Auth\RegisterController@admin'); //has a role of 0

Route::post('register/rentee', 'Auth\RegisterController@rentee'); //has a role of 1

Route::post('register/renter', 'Auth\RegisterController@renter'); //has a role 2

//forgot Password
Route::post('phone/verify', 'Auth\ForgotPasswordController@password');

//Verify account
Route::post('verify', 'Auth\VerificationController@verify');

//Resend Token
Route::get('resend/token', 'Auth\VerificationController@reset');

//Login
Route::post('login', 'Auth\LoginController@authenticate'); //Not Needed


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
