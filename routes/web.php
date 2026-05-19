<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
Route::get('tasks', function () {
    $tasks= DB::table(table:'tasks')->get();
    return view('tasks', compact('tasks'));
});
Route::post('create', function () {
    $task_name = $_POST['name'];
    DB::table(table:'tasks')->insert([
        'name' => $task_name,
    ]);
    return redirect()->back();

});
Route::post('delete/{id}', function ($id) {
    DB::table(table:'tasks')->where('id', $id)->delete();
    return redirect()->back();
});
Route::post('edit/{id}', function ($id) {
    $task = DB::table(table:'tasks')->where('id', $id)->first();
    $tasks= DB::table(table:'tasks')->get();
    return view('tasks', compact('task', 'tasks'));
});
Route::post('update', function () {
    $id = $_POST['id'];
    DB::table(table:'tasks')->where('id', $id)->update([
        'name' => $_POST['name'],
    ]);
    return redirect(to:'tasks');
});
