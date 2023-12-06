<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  // ++ Create User ++
  public function createUser(UserCreateRequest $request)
  {
    User::create([
      'name' => $request->name,
      'fullname' => $request->fullname,
      'email' => $request->email,
      'password' => Hash::make('123456'),
    ]);

    return response()->json([
      'message' => 'User created successfully'
    ], 200);
  }

  // ++ List Users ++
  public function getListUsers()
  {
    $users = User::all();
    return response()->json([
      'data' => $users
    ], 200);
  }

  // ++ Get User ++
  public function getUser($id)
  {
    $user = User::find($id);

    // -- Errors
    if (is_null($user)) {
      return response()->json(["message" => "User not found"], 404);
    }
    return response()->json([
      'data' => $user
    ], 200);
  }

  // ++ Update User ++
  public function updateUser(UserUpdateRequest $request, $id)
  {
    $user = User::find($id);

    // -- Errors
    if (is_null($user)) {
      return response()->json(["message" => "User not found"], 404);
    }
    $user->update([
      'name' => $request->name,
      'fullname' => $request->fullname,
      'email' => $user->email,
    ]);

    return response()->json(['message' => "User updated successfully."], 200);
  }

  public function deleteUser($id)
  {
    $user = User::find($id);
    // ++ Errors
    if (is_null($user)) {
      return response()->json(["message" => "User not found"], 404);
    }
    // ++ Delete
    $user->delete();
    return response()->json(['message' => "User delete successfully."], 200);
  }
}
