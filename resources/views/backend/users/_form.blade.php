<div class="grid grid-cols-6 gap-x-10 gap-y-8">
  <!-- Name -->
  <div class="relative z-0 form-group col-span-6 mt-2 sm:col-span-3 md:col-span-2">
    <x-forms.input-floating label="Nombre" name="name" type="text" class="required" :value="$user->name ?? null" />
  </div>

  <!-- Email -->
  <div class="relative z-0 form-group col-span-6 mt-2 sm:col-span-3 md:col-span-2">
    <x-forms.input-floating label="Email" name="email" type="email" class="required" :value="$user->email ?? null" />
  </div>

  <!-- Birthdate -->
  <div class="relative z-0 col-span-6 mt-2 sm:col-span-3 md:col-span-2">
    <x-forms.date-range id="birthdate" name="birthdate" label="Fecha de nacimiento" :value="$user->birthdate ?? null" mode="age" />
  </div>

  <!-- Password -->
  <div class="relative z-0 col-span-6 mt-2 sm:col-span-3 md:col-span-2">
    <x-forms.input-floating label="{{ isset($user) ? 'Contraseña (opcional)' : 'Contraseña' }}" name="password" type="password" />
  </div>
  <div class="relative z-0 col-span-6 mt-2 sm:col-span-3 md:col-span-2">
    <x-forms.input-floating label="{{ isset($user) ? 'Confirmar contraseña (opcional)' : 'Confirmar contraseña' }}" name="password_confirmation" type="password" />
  </div>
</div>

<div class="form-group mb-4">
  <div class="mt-5 mb-4">
    <label class="mb-1 block font-medium">Avatar</label>
    <div id="avatar-dropzone" class="dropzone"></div>
    <input type="file" name="avatar" id="avatar-input" class="hidden" accept="image/*" />
  </div>
</div>