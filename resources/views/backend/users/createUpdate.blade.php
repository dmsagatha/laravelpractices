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

        <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @if (isset($user)) @method('PUT') @endif
        
          @include('backend.users._form')

        <div class="pt-4 bg-slate-50 dark:bg-slate-800 text-center space-y-2">
          <button type="submit" class="inline-flex items-center justify-center bg-green-600 border border-transparent rounded-md font-medium px-3 py-2 mt-4 mr-2 mb-2 text-center text-white hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring-0 focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
            {{ isset($user) ? 'Actualizar' : 'Crear' }}
          </button>
        </div>

          <!-- AVATAR SIN DROPZONE -->
          <!-- Avatar actual (solo en edición) -->
          {{-- @if(isset($user) && $user->avatar)
            <div class="flex items-center space-x-4">
              <img src="{{ asset('storage/'.$user->avatar) }}" alt="Avatar actual" class="w-20 h-20 rounded-full object-cover border border-gray-300 dark:border-gray-600">
            </div>
          @endif --}}

          <!-- Avatar nuevo -->
          {{-- <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              {{ isset($user) ? 'Cambiar Avatar' : 'Subir Avatar' }}
            </label>
            <input type="file" name="avatar" accept="image/*" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-gray-200">
            @error('avatar')
              <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div> --}}

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
        </form>
      </div>
    </div>
  </div>

  @push('scripts')
    {{-- <script>
      var loadFile = function(event) {
        var input = event.target;
        var file = input.files[0];
        var type = file.type;

        var output = document.getElementById('preview_img');

        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
          URL.revokeObjectURL(output.src) // free memory
        }
      };
    </script> --}}
    
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    
    <script>
      Dropzone.autoDiscover = false;
          
      const avatarDropzone = new Dropzone("#avatar-dropzone", {
        url: "#", // no se usa
        autoProcessQueue: false,
        maxFiles: 1,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        dictDefaultMessage: "Arrastra o haz clic para subir una imagen",
        init: function() {
          // Si $user->avatar es NULL, no carga nada
          @if(isset($user) && $user->avatar)
            const mockFile = { name: "Avatar actual", size: 12345, type: 'image/jpeg' };
            this.displayExistingFile(mockFile, "{{ asset('storage/'.$user->avatar) }}");
            this.files.push(mockFile);
          @endif

          this.on("addedfile", file => {
            if (this.files.length > 1) {
              this.removeFile(this.files[0]);
            }
          });
        }
      });

      // Botón para quitar avatar
      document.getElementById("remove-avatar-btn").addEventListener("click", function () {
        avatarDropzone.removeAllFiles(true); // limpiar dropzone
        // Marcar hidden input para el backend
        let input = document.querySelector("input[name='remove_avatar']");
        if (!input) {
          input = document.createElement("input");
          input.type = "hidden";
          input.name = "remove_avatar";
          input.value = "1";
          document.getElementById("user-form").appendChild(input);
        } else {
            input.value = "1";
        }
      });

      // Interceptar el submit
      document.getElementById("user-form").addEventListener("submit", function(e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);

        if (avatarDropzone.getAcceptedFiles().length) {
          formData.append("avatar", avatarDropzone.getAcceptedFiles()[0]);
        }

        fetch(form.action, {
          method: form.method,
          body: formData,
          headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
          }
        }).then(response => {
          if (response.ok) {
            window.location.href = "{{ route('users.index') }}";
          }
        });
      });
    </script>      
  @endpush
</x-app-layout>