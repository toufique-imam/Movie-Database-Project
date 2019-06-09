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
Route::view('/Edit/{category}/{problem_id}/Add', 'Add\Add_entity');
Route::view('/Details/{category}/{problem_id}/Add', 'Add\Add_entity');


Route::view('Delete','Delete\delete_actor');
Route::view('/Edit/{category}/{problem_id}/Delete', 'Delete\delete_actor');
Route::view('/Details/{category}/{problem_id}/Delete', 'Delete\delete_actor');

Route::view('Edit','Edit\Edit_Movie');
Route::view('/Edit/{category}/{problem_id}/Edit', 'Edit\Edit_Movie');
Route::view('/Details/{category}/{problem_id}/Edit', 'Edit\Edit_Movie');

Route::view('Search','Search\search_res');
Route::view('/Edit/{category}/{problem_id}/Search', 'Search\search_res');
Route::view('/Details/{category}/{problem_id}/Search', 'Search\search_res');

Route::view('AdvanceSearch','Search\advance_Search');
Route::view('/Edit/{category}/{problem_id}/AdvanceSearch', 'Search\advance_Search');
Route::view('/Details/{category}/{problem_id}/AdvanceSearch', 'Search\advance_Search');

Route::post('category','Add_Entity_Controller@category_define');
Route::post('/Edit/{category}/{problem_id}/category','Add_Entity_Controller@category_define');
Route::post('/Details/{category}/{problem_id}/category', 'Add_Entity_Controller@category_define');

Route::post('AddMovie', 'Add_Entity_Controller@AddMovie');
Route::post('/Edit/{category}/{problem_id}/AddMovie','Add_Entity_Controller@AddMovie');
Route::post('/Details/{category}/{problem_id}/AddMovie', 'Add_Entity_Controller@AddMovie');

Route::post('AddActor', 'Add_Entity_Controller@AddActor');
Route::post('/Edit/{category}/{problem_id}/AddActor','Add_Entity_Controller@AddActor');
Route::post('/Details/{category}/{problem_id}/AddActor', 'Add_Entity_Controller@AddActor');

Route::post('AddDirector', 'Add_Entity_Controller@AddDirector');
Route::post('/Edit/{category}/{problem_id}/AddDirector','Add_Entity_Controller@AddDirector');
Route::post('/Details/{category}/{problem_id}/AddDirector', 'Add_Entity_Controller@AddDirector');

Route::post('Search','View_Entity_Controller@Search');
Route::post('/Edit/{category}/{problem_id}/Search', 'View_Entity_Controller@Search');
Route::post('/Details/{category}/{problem_id}/Search', 'View_Entity_Controller@Search');

Route::post('srch_category','AdvanceSearch_Controller@category_define');
Route::post('/Edit/{category}/{problem_id}/srch_category', 'AdvanceSearch_Controller@category_define');
Route::post('/Details/{category}/{problem_id}/srch_category', 'AdvanceSearch_Controller@category_define');

Route::post('SearchMovie','AdvanceSearch_Controller@Search_movie');
Route::post('/Edit/{category}/{problem_id}/SearchMovie', 'AdvanceSearch_Controller@Search_movie');
Route::post('/Details/{category}/{problem_id}/SearchMovie', 'AdvanceSearch_Controller@Search_movie');

Route::post('SearchActor','AdvanceSearch_Controller@Search_actor');
Route::post('/Edit/{category}/{problem_id}/SearchActor','AdvanceSearch_Controller@Search_actor');
Route::post('/Details/{category}/{problem_id}/SearchActor', 'AdvanceSearch_Controller@Search_actor');

Route::post('SearchDirector', 'AdvanceSearch_Controller@Search_director');
Route::post('/Edit/{category}/{problem_id}/SearchDirector','AdvanceSearch_Controller@Search_director');
Route::post('/Details/{category}/{problem_id}/SearchDirector', 'AdvanceSearch_Controller@Search_director');

Route::get('/Edit/{category}/{problem_id}/Edit','Edit_Entity_Controller@EditData');
Route::post('/Edit/{category}/{problem_id}/EditMovie','Edit_Entity_Controller@EditMovie');
Route::post('/Edit/{category}/{problem_id}/EditActor','Edit_Entity_Controller@EditActor');
Route::post('/Edit/{category}/{problem_id}/EditDirector','Edit_Entity_Controller@EditDirector');

Route::get('/Details/{category}/{problem_id}/Details', 'DetailsView_Controller@Details');

Route::get('/Delete/{category}/{problem_id}/Delete', 'Delete_Entity_Controller@DeleteData');
