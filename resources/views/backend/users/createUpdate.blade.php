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
      var dropzone = new Dropzone("#avatar-dropzone", {
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
      });
    </script>
  @endpush
</x-app-layout>