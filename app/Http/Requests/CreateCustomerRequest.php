<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
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
      'cpf' => sanitize($this->cpf),
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
      'cpf' => ['required', 'string', 'min:11', 'max:14', 'unique:customers,cpf'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
    ];
  }
}
