<div class="grid grid-cols-6 gap-x-10 gap-y-8">
  <!-- Name -->
  <div class="relative z-0 col-span-6 sm:col-span-3 md:col-span-2 mt-2">
    <x-forms.input-floating label="Nombre" name="name" type="text" :value="$user->name ?? null" />
  </div>
          
  <!-- Email -->
  <div class="relative z-0 col-span-6 sm:col-span-3 md:col-span-2 mt-2">
    <x-forms.input-floating label="Email" name="email" type="email" :value="$user->email ?? null" />
  </div>
          
  <!-- Password -->
  <div class="relative z-0 col-span-6 sm:col-span-3 md:col-span-2 mt-2">
    <x-forms.input-floating label="{{ isset($user) ? 'Contraseña (opcional)' : 'Contraseña' }}" name="password" type="password" />
  </div>
  <div class="relative z-0 col-span-6 sm:col-span-3 md:col-span-2 mt-2">
    <x-forms.input-floating label="{{ isset($user) ? 'Confirmar contraseña (opcional)' : 'Confirmar contraseña' }}" name="password_confirmation" type="password" />
  </div>
</div>