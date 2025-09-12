<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ isset($user) ? 'Editar Usuario' : 'Crear Usuario' }}
    </h2>
  </x-slot>

  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-slate-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 text-gray-900 dark:text-gray-100">
        <!-- Alerta de respuesta -->
        @if (Session::has('success'))
          <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
            <span class="font-medium">{{ Session::get('success') }}</span>
          </div>
        @elseif (Session::has('error'))
          <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100" role="alert">
            <span class="font-medium">{{ Session::get('error') }}</span>
          </div>
        @endif

        <form id="user-form" action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @if (isset($user))
            @method('PUT')
          @endif
          
          <div class="grid grid-cols-6 gap-x-10 gap-y-8">
            <!-- Name -->
            <div class="relative z-0 col-span-6 sm:col-span-3 md:col-span-2 mt-2">
              <x-forms.input-floating label="Nombre" name="name" type="text" :value="$user->name ?? null" />
            </div>

            <!-- Email -->
            <div class="relative z-0 col-span-6 sm:col-span-3 md:col-span-2 mt-2">
              <x-forms.input-floating label="Correo electrónico" name="email" type="email" :value="$user->email ?? null" />
            </div>

            <!-- Password -->
            <div class="relative z-0 col-span-6 sm:col-span-3 md:col-span-2 mt-2">
              <x-forms.input-floating label="{{ isset($user) ? 'Contraseña (opcional)' : 'Contraseña' }}" name="password" type="password" />
            </div>

            <div class="relative z-0 col-span-6 sm:col-span-3 md:col-span-2 mt-2">
              <x-forms.input-floating label="{{ isset($user) ? 'Confirmar contraseña (opcional)' : 'Confirmar contraseña' }}" name="password_confirmation" type="password"/>
            </div>
          </div>

          <!-- AVATAR CON DROPZONE -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              {{ isset($user) ? 'Cambiar Avatar' : 'Subir Avatar' }}
            </label>
          
            <div id="avatar-dropzone" class="dropzone border-2 border-dashed rounded-lg p-4 bg-gray-50 dark:bg-slate-700">
            </div>
          
            @error('avatar')
              <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div class="mt-2">
            <button type="button" id="remove-avatar-btn" class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700">
              Quitar avatar
            </button>
          </div>

          <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-4">
            {{ isset($user) ? 'Actualizar' : 'Crear' }}
          </button>
        </form>
      </div>
    </div>
  </div>

  @push('scripts')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
      Dropzone.autoDiscover = false;

      const avatarDropzone = document.getElementById("avatar-dropzone");
      if (avatarDropzone) {
        new Dropzone("#avatar-dropzone", {
          url: "#", // Evita subida inmediata, el form normal se encarga
          autoProcessQueue: false,
          maxFiles: 1,
          acceptedFiles: "image/*",
          addRemoveLinks: true,
          init: function () {
              this.on("addedfile", file => {
                  const reader = new FileReader();
                  reader.onload = e => {
                      let preview = document.getElementById("preview-image");
                      if (!preview) {
                          preview = document.createElement("img");
                          preview.id = "preview-image";
                          preview.className = "w-24 h-24 rounded mt-2";
                          avatarDropzone.parentNode.appendChild(preview);
                      }
                      preview.src = e.target.result;
                  };
                  reader.readAsDataURL(file);
              });
              this.on("removedfile", () => {
                  const preview = document.getElementById("preview-image");
                  if (preview) preview.remove();
              });
          }
        });
      }
    </script>
  @endpush
</x-app-layout>