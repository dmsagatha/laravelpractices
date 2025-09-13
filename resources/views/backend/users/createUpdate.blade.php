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

        <form id="userForm" action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @if (isset($user)) @method('PUT') @endif
        
          @include('backend.users._form')

          <div class="pt-4 bg-slate-50 dark:bg-slate-800 text-center space-y-2">
            <button type="submit" class="inline-flex items-center justify-center bg-green-600 border border-transparent rounded-md font-medium px-3 py-2 mt-4 mr-2 mb-2 text-center text-white hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring-0 focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
              {{ isset($user) ? 'Actualizar' : 'Crear' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
  @endpush

  @push('scripts')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
      Dropzone.autoDiscover = false;

      document.addEventListener("DOMContentLoaded", function() {
        var inputFile = document.getElementById('avatar-input');

        var avatarDropzone = new Dropzone("#avatar-dropzone", {
          url: "#", // No se sube por AJAX, se envía con el form
          autoProcessQueue: false,
          addRemoveLinks: true,
          maxFiles: 1,
          acceptedFiles: "image/*",
          dictDefaultMessage: "Suelte el archivo o haga clic para cargar",
          dictRemoveFile: "Eliminar archivo", // <-- Traducción al español
          previewsContainer: "#avatar-dropzone", // importante, solo un área de preview
          init: function() {
            this.on("addedfile", function(file) {
              // Solo para archivos nuevos
              if (file instanceof File) {
                var dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                inputFile.files = dataTransfer.files;
              }
            });
            this.on("removedfile", function() {
              inputFile.value = "";
            });

            // Modo edición: muestra avatar actual solo como mockFile
            @if(isset($user) && $user->avatar)
              this.removeAllFiles(true); // Limpia cualquier preview previa
              var mockFile = { name: "Avatar", size: 12345 };
              this.emit("addedfile", mockFile);
              this.emit("thumbnail", mockFile, "{{ asset('storage/'.$user->avatar) }}");
              this.emit("complete", mockFile);
              this.files.push(mockFile); // Para que Dropzone lo cuente como existente
            @endif
          }
        });
      });

      /* Segunda versión*/
      /* document.addEventListener("DOMContentLoaded", function() {
        var preview = document.getElementById('avatar-preview');
        var inputFile = document.getElementById('avatar-input');

        var avatarDropzone = new Dropzone("#avatar-dropzone", {
          url: "#", // No se sube por AJAX, se envía con el form
          autoProcessQueue: false,
          addRemoveLinks: true,
          maxFiles: 1,
          acceptedFiles: "image/*",
          dictDefaultMessage: "Arrastrar o hacer clic para seleccionar el avatar",
          init: function() {
            this.on("addedfile", function(file) {
              // Solo hacer FileReader si file es de tipo File (nuevo archivo)
              if (file instanceof File) {
                var reader = new FileReader();
                reader.onload = function(e) {
                  preview.src = e.target.result;
                  preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);

                var dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                inputFile.files = dataTransfer.files;
              } else {
                // Si es mock file, solo mostrar la imagen actual
                preview.src = file.dataURL || file.url || preview.src;
                preview.classList.remove('hidden');
              }
            });
            this.on("removedfile", function() {
              preview.classList.add('hidden');
              preview.src = "#";
              inputFile.value = "";
            });

            // Modo edición: muestra avatar actual
            @if(isset($user) && $user->avatar)
              var mockFile = { name: "avatar.jpg", size: 12345 };
              this.emit("addedfile", mockFile);
              this.emit("thumbnail", mockFile, "{{ asset('storage/'.$user->avatar) }}");
              this.emit("complete", mockFile);
              preview.src = "{{ asset('storage/'.$user->avatar) }}";
              preview.classList.remove('hidden');
            @endif
          }
        });
      }); */

      /* Primera versión*/
      /* var dropzone = new Dropzone("#avatar-dropzone", {
        url: "#",
        autoProcessQueue: false,
        addRemoveLinks: true,
        maxFiles: 1,
        acceptedFiles: "image/*",
        dictDefaultMessage: "Arrastra o haz clic para seleccionar el avatar",
        init: function() {
          this.on("addedfile", function(file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
                document.getElementById('avatar-preview').classList.remove('hidden');
            }
            reader.readAsDataURL(file);

            var dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            document.getElementById('avatar-input').files = dataTransfer.files;
          });
          this.on("removedfile", function() {
            document.getElementById('avatar-preview').classList.add('hidden');
            document.getElementById('avatar-preview').src = "#";
            document.getElementById('avatar-input').value = "";
          });
        }
      }); */
    </script>
  @endpush
</x-app-layout>