<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
      //  $users = DB::table('users')->get();
        $users= User::all();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)

    {
        $request->validate([
        'name'     => 'required|min:3|max:50',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:4|max:10',
    ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password) ;
        $user->save();
        //$user = DB::table('users')->insert([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => bcrypt($request->password),

    //    ]);

        return redirect('users');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect('users');
    }

    public function edit($id)
    {
        //$users = DB::table('users')->get();
        //$user = DB::table('users')->where('id', $id)->first();
        $user = User::find($id);
                $users= User::all();

        return view('users.index', compact('users', 'user'));
    }

public function update(Request $request)
{
    $request->validate([
        'name'     => 'required|min:3|max:50',
        'email'    => 'required|email|unique:users,email,' . $request->id,
        'password' => 'nullable|min:4|max:10',
    ]);

    $user = User::find($request->id);
    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();
    return redirect('users');
}
}
