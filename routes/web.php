<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    $name = 'Alaa Khudair';

    $departments = [
        '1' => 'Tichnical',
        '2' => 'Financial',
        '3' => 'Sales',
        ];
    //return view('about')->with('name', $name);
    // return view('about', ['name' => $name]);
    return view('about', Compact('name' ,'departments'));
});
Route::post('/about', function () {
    $name = $_POST['name'];
    $departments = [
        '1' => 'Tichnical',
        '2' => 'Financial',
        '3' => 'Sales',
        ];
    return view('about', Compact('name','departments'));

});
Route::get('tasks', [TaskController::class, 'index']);
Route::post('create', [TaskController::class, 'create']);
Route::post('delete/{id}', [TaskController::class, 'destroy']);
Route::get('edit/{id}', [TaskController::class, 'edit']);
Route::post('update', [TaskController::class, 'update']);
Route::get('app', function () {
    return view('layouts.app');
});

Route::get('/users', [UserController::class, 'index']);
Route::post('/users/create', [UserController::class, 'store']);
Route::post('/users/delete/{id}', [UserController::class, 'destroy']);
Route::get('/users/edit/{id}', [UserController::class, 'edit']);
Route::post('/users/update', [UserController::class, 'update']);
