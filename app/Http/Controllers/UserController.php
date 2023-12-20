<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateStatusUserRequest;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  // ------ Create User ------
  public function createUser(UserCreateRequest $request)
  {
    User::create([
      'name' => $request->name,
      'username' => $request->username,
      'email' => $request->email,
      'password' => Hash::make('123456'),
    ]);

    return response()->json([
      'message' => 'User created successfully'
    ], 200);
  }

  // ------ List Users ------
  public function getListUsers()
  {
    $users = User::where("type_user", '!=', 'super')->get();
    return response()->json([
      'items' => $users
    ], 200);
  }

  // ------ Get User ------
  public function getUser($id)
  {
    $user = User::find($id);

    // !!Errors
    if (is_null($user)) {
      return response()->json(["message" => "User not found"], 404);
    }
    return response()->json([
      'item' => $user
    ], 200);
  }

  // ------ Update User ------
  public function updateUser(UserUpdateRequest $request, $id)
  {
    $user = User::find($id);

    // !!Errors
    if (is_null($user)) {
      return response()->json(["message" => "User not found"], 404);
    }
    $user->update([
      'name' => $request->name,
      'username' => $request->username,
      'email' => $request->email,
    ]);

    return response()->json(['message' => "User updated successfully."], 200);
  }

  // ------ Delete User ------
  public function deleteUser($id)
  {
    $user = User::find($id);
    // !!Errors
    if (is_null($user)) {
      return response()->json(["message" => "User not found"], 404);
    }
    $user->delete();
    return response()->json(['message' => "User delete successfully."], 200);
  }

  // ----------- Reset Passwords -----------
  public function resetPasswordUser($id)
  {
    $user = User::find($id);

    // !!Errors
    if (is_null($user)) {
      return response()->json(["message" => "User not found"], 404);
    }
    $user->update([
      'name' => $user->name,
      'username' => $user->username,
      'email' => $user->email,
      'password' => Hash::make("123456"),
    ]);

    return response()->json(['message' => "User updated successfully."], 200);
  }

  // ----------- Activate / Desativae User -----------
  public function changeStatusUser(UpdateStatusUserRequest $request, $id)
  {
    $user = User::find($id);

    // !!Errors
    if (is_null($user)) {
      return response()->json(["message" => "User not found"], 404);
    }
    $user->update([
      'name' => $user->name,
      'username' => $user->username,
      'email' => $user->email,
      'password' => $user->password,
      "active" => $request->active
    ]);

    return response()->json(['message' => "User updated successfully."], 200);
  }
}
