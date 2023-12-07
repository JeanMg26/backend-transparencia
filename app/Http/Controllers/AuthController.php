<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
  // --------- REGISTER ---------
  public function register(RegisterRequest $request)
  {
    $user = User::create([
      'name' => $request->get('name'),
      'username' => $request->get('username'),
      'email' => $request->get('email'),
      'password' => Hash::make($request->get('password')),
    ]);

    $token = JWTAuth::fromUser($user);

    return response()->json(compact('user', 'token'), 201);
  }

  // --------- LOGIN ---------
  public function login(LoginRequest $request)
  {
    $credentials = $request->only('username', 'password');
    try {
      if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json(['error' => 'invalid_credentials', "code" => 1000], 400);
      }
    } catch (JWTException $e) {
      return response()->json(['error' => 'could_not_create_token'], 500);
    }
    return response()->json([
      'message' => 'Login successfully',
      'jwt' => $token
    ], 200);
  }

  // --------- GET USER ---------
  public function getUser()
  {
    try {
      if (!$user = JWTAuth::parseToken()->authenticate()) {
        return response()->json(['user_not_found'], 404);
      }
    } catch (TokenExpiredException $e) {
      return response()->json(['token_expired'], $e->getStatusCode());
    } catch (TokenInvalidException $e) {
      return response()->json(['token_invalid'], $e->getStatusCode());
    } catch (JWTException $e) {
      return response()->json(['token_absent'], $e->getStatusCode());
    }
    return response()->json(compact('user'));
  }
}
