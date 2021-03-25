<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {

    public function index()
    {
        return response()->json(['users' => User::all()]);
    }

    public function store(Request $request)
    {

        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "min:6|required",
        ]);
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        return response()->json("success");

    }

    public function edit(User $id)
    {
        return $id;
    }

    public function update(Request $request)
    {

        $user = User::find($request->id);
        $request->validate([
            "name" => "required",
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        $user->update([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        return response()->json("success");
    }

    public function destroy($id)
    {

        User::find($id)->delete();

        return response()->json("success");

    }

}