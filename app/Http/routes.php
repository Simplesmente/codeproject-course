<?php
use CodeProject\Repositories\ProjectRepository;
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


Route::get('/',function(){
    return view('app');
});

Route::post('oauth/access_token', function(){
    return Response::json(Authorizer::issueAccessToken());
});


Route::group(['middleware' => 'oauth'], function(){

  Route::resource('client', 'ClientController', ['except' => ['create','edit']]);
  Route::resource('tasks', 'ProjectTaskController', ['except' => ['create','edit']]);
  Route::resource('project', 'ProjectController',['except' => ['create', 'edit']]);

  // Route::group(['middleware' =>'CheckProjectOwner' ], function(){
  //   Route::resource('project', 'ProjectController',['except' => ['create', 'edit']]);
  // });

  Route::group(['prefix' => 'project'], function(){

        Route::get('{id}/notes','ProjectNoteController@index');
        Route::post('{id}/notes','ProjectNoteController@store');
        Route::get('{id}/notes/{noteId}','ProjectNoteController@show');
        Route::put('{id}/notes/{noteId}','ProjectNoteController@update');
        Route::delete('{id}/notes/{noteId}','ProjectNoteController@destroy');

        Route::post('{id}/file','ProjectFileController@store');
        Route::delete('{id}/file/{fileId}','ProjectFileController@destroy');

  });


  Route::get('user/authenticated','UserController@authenticated');

});




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
