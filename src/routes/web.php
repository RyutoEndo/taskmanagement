<?php

use App\Task;
use Illuminate\Support\Facades\Route;
use App\Request;
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
    return view('welcome');
});

/**
 *
 */
Route::post('/task', function (Request $request) {
    //
});

/**
 * タスク削除
 */
Route::delete('/task/{task}', function (Task $task) {
    //
});
