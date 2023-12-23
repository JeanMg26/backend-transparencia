<?php

namespace App\Http\Requests\Article;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateArticleRequest extends FormRequest
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
      'title' => 'required|max:100',
      'description' => 'required',
      'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
      'route' => 'required|unique:articles,route,except,id',
      'autor' => 'min:2',
      'category_id' => 'required'
    ];
  }


  public function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(response()->json([
      'message'   => 'Error fields',
      'errors'      => $validator->errors()
    ], 400));
  }

  public function messages()
  {
    return [
      'description.required' => '1005',
    ];
  }
}
