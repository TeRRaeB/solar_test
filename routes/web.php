<?php

use App\Comment;
use App\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//Route::get('/', CommentsController::index());

Route::get('/', 'CommentsController@allComments')->name('index');
// Добавление комментария:
Route::post('/', 'CommentsController@store')->name('AddComment');
// Удаление комментария:
Route::delete('/{comment}', 'CommentsController@delete')->name('DeleteComment');
// Редактирование комментария
Route::post('/post', 'CommentsController@edit')->name('Edit');
// Просмотреть комментарии к комментарию
Route::post('/parent', 'CommentsController@findParent')->name('Parent');