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

    $rules = [
      'name'   => ['required', 'string', 'max:255'],
      'email'  => ['required', 'email', 'unique:users,email,' . $userId],
      'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
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

  /* public function messages(): array
  {
    return [
      'name.required'      => 'El nombre es obligatorio.',
      'email.required'     => 'El email es obligatorio.',
      'email.unique'       => 'Este email ya está en uso.',
      'password.required'  => 'La contraseña es obligatoria en la creación.',
      'password.confirmed' => 'Las contraseñas no coinciden.',
      'avatar.image'       => 'El archivo debe ser una imagen.',
      'avatar.mimes'       => 'Formatos permitidos: jpg, jpeg, png.',
    ];
  } */
}