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
  {{-- <div class="mb-4">
    <label class="block font-medium mb-1">Password 
      @if(isset($user))
        <span class="text-gray-500">(Dejar vacío para no cambiar)</span>
      @endif
    </label>
    <input type="password" name="password" class="border rounded w-full px-3 py-2" {{ isset($user) ? '' : 'required' }}>
  </div> --}}
</div>


<div class="form-group mb-4">
  <div class="mb-4">
    <label class="block font-medium mb-1">Avatar</label>
    {{-- @if(isset($user) && $user->avatar)
      <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/default-noavatar.png') }}" alt="Avatar" class="mb-2 w-24 h-24 rounded object-cover" />
    @endif
    <div id="avatar-dropzone" class="dropzone"></div>
    <input type="file" name="avatar" id="avatar-input" class="hidden" accept="image/*">
    <img id="avatar-preview" src="#" alt="Avatar Preview" class="mt-2 hidden w-24 h-24 rounded object-cover"> --}}

    <div id="avatar-dropzone" class="dropzone"></div>
    <input type="file" name="avatar" id="avatar-input" class="hidden" accept="image/*">
  </div>
</div>