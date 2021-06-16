<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return auth()->guard()->check();
  }

  /**
   * Prepare the data for validation.
   *
   * @return void
   */
  protected function prepareForValidation()
  {
    $this->merge([
      'discount' => (int)sanitize($this->discount ?? 0),
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
//      'customer_id' => ['required', 'numeric', 'integer', 'exists:customers,id'],
      'discount' => ['required', 'numeric', 'integer', 'min:0'],
      'items' => ['required', 'array', 'min:1'],
      'items.*.product_id' => ['required', 'numeric', 'integer', 'exists:products,id'],
      'items.*.quantity' => ['required', 'numeric', 'integer', 'min:1'],
    ];
  }
}
