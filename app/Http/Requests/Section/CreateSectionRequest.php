<?php

namespace App\Http\Requests\Section;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateSectionRequest extends FormRequest
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
      'title' => 'required|max:50',
      'description' => 'required',
      'autor' => 'min:2',
      'subcategory_id' => 'required'
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
