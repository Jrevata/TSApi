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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login' , 'AuthenticateController@authenticate')->name('login');



Route::middleware(['jwt.auth'])->group(function(){
    
    Route::post('logout','AuthenticateController@logout')->name('logout');
    
    Route::post('users/changePassword/{idUser}', 'AuthenticateController@changePassword');
    
    //Projects
    Route::get('projects/getAll' , 'ProjectController@index');
    Route::post('projects/store', 'ProjectController@store');
    Route::post('projects/update/{id}', 'ProjectController@update');
    Route::get('projects/getUsersByProject/{id}', 'ProjectController@getUsersByProject');
    Route::delete('projects/destroy/{id}', 'ProjectController@destroy');
    
    
    //Users
    Route::get('users/getAll', 'UserController@index');
    Route::post('users/newUser', 'UserController@store');
    Route::post('users/editUser/{id}', 'UserController@update');
    Route::get('users/getProjectsByUser/{id}', 'UserController@getProjectsByUser');
    Route::post('users/update/{id}' , 'UserController@update');
    Route::post('users/updateByAdmin/{id}','UserController@updateUserbyAdmin');
    Route::get('users/prueba', 'UserController@createNameValidForDate');
    Route::post('users/showUser', 'UserController@showUser');
    Route::delete('users/destroy/{idUser}', 'UserController@destroy');
    
    
    //Sprints
    Route::post('sprints/newSprint', 'SprintController@store');
    Route::post('sprints/editSprint/{id}', 'SprintController@update');
    Route::get('sprints/getAllbyProject/{id}', 'SprintController@getSprintsbyProject');
    Route::delete('sprints/destroy/{id}', 'SprintController@destroy');
    
    //Dailies
    Route::post('dailies/store', 'DailyController@store');
    Route::get('dailies/listDailies/{idsprint}/{iduser}', 'DailyController@listDailies');
    Route::get('dailies/show/{id}', 'DailyController@show');
    
    
    //MoodToday
    Route::post('moodtoday/store', 'MoodTodayController@store');
    Route::get('moodtoday/listMoodTodays/{idsprint}/{iduser}', 'MoodTodayController@listMoodTodays');
    Route::get('moodtoday/show/{id}', 'MoodTodayController@show');
    
    //Comments
    Route::get('comments/getCommentsBySprint/{id}', 'CommentController@getCommentsBySprint');
    Route::post('comments/store', 'CommentController@store');
    
    //Team
    Route::post('team/addMember', 'UserProjectController@addMember');
    Route::delete('team/deleteMember/{idUser}/{idProject}', 'UserProjectController@deleteMember');
});