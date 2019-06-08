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

Route::get('/', function () {
    return view('home');
});

Route::view('Add','Add\Add_entity');
Route::view('Delete','Delete\delete_actor');
Route::view('Edit','Edit\Edit_Movie');
Route::view('Search','Search\search_res');
Route::view('AdvanceSearch','Search\advance_Search');

Route::post('category','Add_Entity_Controller@category_define');
Route::post('AddMovie','Add_Entity_Controller@AddMovie');
Route::post('AddActor','Add_Entity_Controller@AddActor');
Route::post('AddDirector','Add_Entity_Controller@AddDirector');

Route::post('Search','View_Entity_Controller@Search');


Route::post('srch_category','AdvanceSearch_Controller@category_define');
Route::post('SearchMovie','AdvanceSearch_Controller@Search_movie');
Route::post('SearchActor','AdvanceSearch_Controller@Search_actor');
Route::post('SearchDirector','AdvanceSearch_Controller@Search_director');
