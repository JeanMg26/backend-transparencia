<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserCreateRequest extends FormRequest
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
      'username' => 'required|min:4|max:15|unique:users',
      'email' => 'required|email|max:100|unique:users'
    ];
  }

  public function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(response()->json([
      'message'   => 'Fields empties',
      'data'      => $validator->errors()
    ], 400));
  }
}
