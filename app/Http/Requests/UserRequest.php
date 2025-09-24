<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    $userId = $this->route('user')?->id;
    $today = now();
    $minDate = $today->copy()->subYears(65)->format('Y-m-d'); // 65 años atrás
    $maxDate = $today->copy()->subYears(18)->format('Y-m-d'); // Al menos 18 años

    $rules = [
      'name'   => ['required', 'string', 'max:255'],
      'email'  => ['required', 'email', 'unique:users,email,' . $userId],
      'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
      'birthdate' => [
        'required',
        'date',
        "after_or_equal:$minDate",
        "before_or_equal:$maxDate",
      ],
    ];

    if ($this->isMethod('post')) {
      // Store
      $rules['password'] = ['required', 'string', 'min:5', 'confirmed'];
    } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
      // Update
      $rules['password'] = ['nullable', 'string', 'min:5', 'confirmed'];
    }

    return $rules;
  }
}