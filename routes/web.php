<?php

Route::get("/", "IndexController@index")->name("homeIndexPage");
Route::get('login', "IndexController@handle_request");

//Overwirte All Default Login-Registration Routes
Route::group(['middleware' => ['web']], function() {

// Login Routes...
    //Route::get('admin', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
    Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// Registration Routes...
    // Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
    //Route::post('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@register']);

// Password Reset Routes...
    //Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    //Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    //Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
    //Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);
});


// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




//User/Admin panel routes
Route::group(['as'=>'application.', 'prefix'=>'application', 'namespace'=>'Backend\Application', 'middleware'=>['auth', 'userMW']], function(){
	//store manage
    Route::resource('stores', 'StoreController');

    //input data controller
    Route::resource('input', 'InputDataController');
    Route::get('get-data/{storeID}', 'InputDataController@get_data')->name('getDataByStore');
    
    //get report
    Route::get('report', 'InputDataController@get_report')->name('get.report');

    //questions
    Route::get('questions', 'QuestionController@questions')->name('questionsPage');
    Route::post('questions/add', 'QuestionController@question_add')->name('question.store');
    Route::get('questions/edit/{id}', 'QuestionController@question_edit')->name('question.edit');
    Route::post('questions/update', 'QuestionController@question_update')->name('question.update');
    Route::post('questions/destroy', 'QuestionController@question_destroy')->name('question.destroy');

    //worker mange only for admin
    Route::resource('workers', 'WorkerController');



    //Custoer controller
    Route::resource('customers', 'CustomerController');
    
    
    //search controller
    Route::get('get/stores/all', 'SearchController@get_stores');
    Route::get('search/{searchIn}/{searchKey}', 'SearchController@search_top')->name('topSearchBar');
        
    //profile controller
    Route::resource('profile', 'ProfileController');
    Route::post('change-password', 'ProfileController@change_password')->name("passwordChange");
    
});