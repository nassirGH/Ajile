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


Auth::routes();


Route::group(['middleware' => 'web'], function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('/user', 'UserController')->except(['destroy','edit','update']);
    Route::get('/user/{id}/delete', 'UserController@delete')->name('user.delete');


    Route::resource('/team', 'TeamController')->except(['destroy','edit','update']);
    Route::get('/team/{id}/delete', 'TeamController@delete')->name('team.delete');

    Route::resource('/project', 'ProjectController')->except(['destroy','edit','update']);
    Route::get('/project/{id}/delete', 'ProjectController@delete')->name('project.delete');


    Route::resource('/questionnaire', 'QuestionnaireController')->except(['destroy','edit','update']);
    Route::get('/questionnaire/{id}/delete', 'QuestionnaireController@delete')->name('questionnaire.delete');

    Route::get('/notifications','QuestionController@index')->name('notification.index');
    Route::get('/notification/{id}/show','QuestionController@show')->name('notification.show');
    Route::post('/notification/{id}/store','QuestionController@store')->name('notification.store');
});