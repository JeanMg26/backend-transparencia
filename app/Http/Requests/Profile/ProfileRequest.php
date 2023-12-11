<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'name' => 'required|min:4|max:100',
      'username' => 'required|min:4|max:15|unique:users,username,' . Auth::user()->id,
      'email' => 'required|email|max:100|unique:users,email,' . Auth::user()->id,
      'password' => 'min:6|max:50'
    ];
  }

  public function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(response()->json([
      'message'   => 'Fields error',
      'errors'      => $validator->errors()
    ], 400));
  }

  public function messages()
  {
    return [
      'username.unique' => '1001',
      'email.unique' => '1002',
    ];
  }
}
