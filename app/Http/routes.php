<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/client',['as' =>'client', 'uses' => 'ClientController@index']);

Route::post('/client',['as' =>'client', 'uses' => 'ClientController@store']);

Route::get('/client/{id}',['as' =>'client', 'uses' => 'ClientController@show']);

Route::delete('/client/{id}',['as' =>'client', 'uses' => 'ClientController@destroy']);

Route::put('/client/{id}',['as' =>'client', 'uses' => 'ClientController@update']);


Route::get('/project/{id}/note',['as' =>'projectNote', 'uses' => 'ProjectNoteController@index']);
Route::post('/project/{id}/note',['as' =>'projectNote', 'uses' => 'ProjectNoteController@store']);
Route::get('/project/{id}/note/{noteId}',['as' =>'projectNote', 'uses' => 'ProjectNoteController@show']);
Route::put('/project/{id}/note/{noteId}',['as' =>'projectNote', 'uses' => 'ProjectNoteController@update']);
Route::delete('/project/{id}/note/{noteId}',['as' =>'projectNote', 'uses' => 'ProjectNoteController@destroy']);

Route::get('/project',['as' =>'project', 'uses' => 'ProjectController@index']);

Route::post('/project',['as' =>'project', 'uses' => 'ProjectController@store']);

Route::get('/project/{id}',['as' =>'project', 'uses' => 'ProjectController@show']);

Route::delete('/project/{id}',['as' =>'project', 'uses' => 'ProjectController@destroy']);

Route::put('/project/{id}',['as' =>'project', 'uses' => 'ProjectController@update']);


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
