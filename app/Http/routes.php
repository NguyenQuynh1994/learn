<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('client.category');
// });
Route::auth();
Route::get('/', 'HomeController@index');
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', ['as' => 'register', 'uses' => 'Auth\AuthController@postRegister']);
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('/register/verify/{confirmationCode}', 'Auth\AuthController@confirm');
Route::get('/admin_home', 'AdminHomeController@index');
Route::group(['middleware' => 'admin'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('levels', 'Admin\LevelController');
        Route::resource('categories', 'Admin\CategoryController');
        Route::resource('lessons', 'Admin\LessonController');
        Route::resource('lessonWords', 'Admin\LessonWordController');
        Route::post('getLesson', 'Admin\AjaxController@getLesson');
        Route::post('getLessonWord', 'Admin\AjaxController@getLessonWord');
        Route::resource('answers', 'Admin\AnswerController');
        Route::post('updateAnswer', 'Admin\LessonWordController@updateAnswer');
        Route::post('createAnswer', 'Admin\LessonWordController@createAnswer');
        Route::get('deleteAnswer/{id}', 'Admin\LessonWordController@deleteAnswer');
    });
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/category', 'ClientController@category');
    Route::post('lesson', ['as' => 'lesson', 'uses' => 'ClientController@lesson']);
    Route::get('word/{id}', 'ClientController@word');
    Route::post('result', ['as' => 'result', 'uses' => 'ClientController@result']);
    Route::get('createPost', 'ClientController@createPost');
    Route::post('storePost', ['as' => 'storePost', 'uses' => 'ClientController@storePost']);
    Route::get('post', 'ClientController@post');
    Route::get('showPost/{id}', 'ClientController@showPost');
    Route::get('dataChart', 'ClientController@dataChart');
    Route::get('chart', 'ClientController@chart');
});
