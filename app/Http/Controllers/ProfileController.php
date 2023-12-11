<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\ProfileRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
  public function getProfile()
  {
    $profile = Auth::user();

    if (is_null($profile)) {
      return response()->json(["error" => "User not authenticate"]);
    }
    return new ProfileResource($profile);
  }

  public function updateProfile(ProfileRequest $request)
  {
    $profile = Auth::user();

    if (is_null($profile)) {
      return response()->json(["error" => "User not authenticate"]);
    }

    if ($request->password) {
      $check_password = Hash::check($request->password, Auth::user()->password);

      if ($check_password) {
        $profile->update([
          'name' => $request->name,
          'username' => $request->username,
          'email' => $request->email,
          'password' => Hash::make($request->new_password)
        ]);

        return response()->json(['message' => "Profile updated successfully."], 200);
        // ++Password Not Match
      } else {

        return response()->json(['errors' => [
          "password" => [
            'code' => '1004', 'message' => "Password not match."
          ]
        ]], 500);
      }
    } else {
      $profile->update([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
      ]);

      return response()->json(['message' => "Profile updated successfully."], 200);
    }
  }
}
