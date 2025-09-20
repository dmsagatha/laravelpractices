<div class="grid grid-cols-6 gap-x-10 gap-y-8">
  <!-- Name -->
  <div class="relative z-0 col-span-6 sm:col-span-3 md:col-span-2 mt-2">
    <x-forms.input-floating label="Nombre" name="name" type="text" :value="$user->name ?? null" />
  </div>
          
  <!-- Email -->
  <div class="relative z-0 col-span-6 sm:col-span-3 md:col-span-2 mt-2">
    <x-forms.input-floating label="Email" name="email" type="email" :value="$user->email ?? null" />
  </div>

  <!-- Birthdate -->
  {{-- @php
    $today = now();
    $minDate = $today->copy()->subYears(50)->format('Y-m-d');
    $maxDate = $today->copy()->subYears(18)->format('Y-m-d');
  @endphp

  <div class="relative z-0 col-span-6 sm:col-span-3 md:col-span-2 mt-2">
    <label for="birthdate">Fecha de nacimiento</label>
    <input 
      type="date" 
      id="birthdate" 
      name="birthdate"
      value="{{ old('birthdate', $user->birthdate ?? '') }}"
      min="{{ $minDate }}"
      max="{{ $maxDate }}"
      class="rounded border-gray-300 dark:bg-slate-800 dark:text-slate-100"
    >
    @error('birthdate')
      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
  </div> --}}
  <div class="relative z-0 col-span-6 sm:col-span-3 md:col-span-2 mt-2">
    {{-- <x-date-range id="birthdate" name="birthdate" label="Fecha de nacimiento" :value="$user->birthdate ?? null" :min="now()->subYears(50)->format('Y-m-d')" :max="now()->subYears(18)->format('Y-m-d')" /> --}}

      <!-- Edad (18 – 65 años) -->
    <x-date-range 
      id="birthdate"
      name="birthdate"
      label="Fecha de nacimiento"
      mode="age"
    />
  </div>
          
  <!-- Password -->
  <div class="relative z-0 col-span-6 sm:col-span-3 md:col-span-2 mt-2">
    <x-forms.input-floating label="{{ isset($user) ? 'Contraseña (opcional)' : 'Contraseña' }}" name="password" type="password" />
  </div>
  <div class="relative z-0 col-span-6 sm:col-span-3 md:col-span-2 mt-2">
    <x-forms.input-floating label="{{ isset($user) ? 'Confirmar contraseña (opcional)' : 'Confirmar contraseña' }}" name="password_confirmation" type="password" />
  </div>
</div>

<div class="form-group mb-4">
  <div class="mt-5 mb-4">
    <label class="block font-medium mb-1">Avatar</label>    
    <div id="avatar-dropzone" class="dropzone"></div>
    <input type="file" name="avatar" id="avatar-input" class="hidden" accept="image/*">
  </div>
</div>