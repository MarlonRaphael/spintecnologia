<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return auth()->guard('web')->check();
  }

  /**
   * Prepare the data for validation.
   *
   * @return void
   */
  protected function prepareForValidation()
  {
    $this->merge([
      'price' => (int)sanitize($this->price),
    ]);
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name' => ['required', 'string', 'min:3', 'max:150'],
      'description' => ['required', 'string', 'min:3', 'max:255'],
      'barcode' => ['required', 'string', 'min:10', 'max:15', 'unique:products,barcode'],
      'price' => ['required', 'numeric', 'integer', 'min:0'],
    ];
  }
}
