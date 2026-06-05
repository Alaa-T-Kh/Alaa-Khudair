<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        //$tasks= DB::table(table:'tasks')->get();
        $tasks= Task::all();
        return view('tasks', compact('tasks'));
    }
    public function create(request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:10|min:3'
        ]);
        $task_name = $request->name;
        //DB::table(table:'tasks')->insert(['name' => $task_name,]);
        $task = new Task();
        $task->name = $task_name;
        $task->save();
        return redirect()->back();

}
    public function destroy($id)
    {
    DB::table(table:'tasks')->where('id', $id)->delete();
        return redirect()->back();

    }
    public function edit($id)
    {
        //DB::table(table:'tasks')->insert(['name' => $task_name,]);
       // $task = DB::table(table:'tasks')->where('id', $id)->first();
        //$tasks= DB::table(table:'tasks')->get();
        $task = Task::find($id);
        $tasks= Task::all();
        return view('tasks', compact('task', 'tasks'));
    }
    public function update(request $request)
    {
        $request->validate([
        'name' => 'required|min:3|max:10'
        ]);
        //DB::table(table:'tasks')->where('id', $id)->update(['name' => $request->name,]);
        $task = Task::find($request->id);
        $task->name = $request->name ;
        $task->save();
        return redirect(to:'tasks');

    }
}
