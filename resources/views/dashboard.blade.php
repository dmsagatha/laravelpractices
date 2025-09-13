<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-slate-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          {{ __("You're logged in!") }}
          <!-- Card Blog -->
          <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <div
              class="group flex flex-col h-full bg-slate-50 border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
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

              <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex items-center space-x-6">
                  <div class="shrink-0">
                    <img id='preview_img' class="h-16 w-16 object-cover rounded-full"
                      src="{{ asset('images/noavatar.jpeg') }}" alt="Current profile photo" />
                  </div>
                  <label for="avatar" class="block">
                    <span class="sr-only">{{ __('Choose profile photo') }}</span>
                    <input type="file" name="avatar" id="avatar" onchange="loadFile(event)" class="block w-full text-sm text-slate-500
          										file:mr-4 file:py-2 file:px-4
          										file:rounded-full file:border-0
          										file:text-sm file:font-semibold
          										file:bg-violet-50 file:text-violet-700
          										hover:file:bg-violet-100
          									" />
                  </label>
                </div>
                @error('avatar')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <div
                  class="mt-auto flex border-t border-gray-200 divide-x divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">
                  <button type="submit"
                    class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-es-xl bg-slate-50 text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                    Guardar y Redimensionar
                  </button>
                </div>
              </form>
            </div>

            {{-- <div class="flex items-center justify-center w-full">
              <label for="dropzone-file"
                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-b800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                  <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L7 9m3-3 3 3" />
                  </svg>
                  <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                      upload</span> or drag and drop</p>
                  <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                </div>
                <input id="dropzone-file" type="file" class="hidden" />
              </label>
            </div> --}}
          </div>

          {{-- <div x-data="activateImagePreview()" x-ref="previewsContainer">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200" for="fileUpload">
              Selecciona una o más imágenes
            </label>
            <input id="fileUpload"
              class="block w-full text-sm border border-gray-300 rounded-md cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600"
              type="file" multiple @change="showPreview(event)" />
            <div class="mt-2 flex flex-wrap gap-2" x-ref="previewArea">
              <!-- Las vistas previas se mostrarán aquí -->
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
  <script>
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
  </script>

  {{-- <script>
    // Ejemplo con Alpine.js (para usar en el ejemplo HTML)
      document.addEventListener('alpine:init', () => {
        Alpine.data('activateImagePreview', () => ({
          showPreview(event) {
            const fileInput = event.target;
            const previewArea = this.$refs.previewArea;
            previewArea.innerHTML = ''; // Limpiar vistas previas anteriores
            
            Array.from(fileInput.files).forEach(file => {
              const reader = new FileReader();
              reader.onload = (e) => {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.classList.add('w-24', 'h-24', 'object-cover', 'rounded-md'); // Estilo para la imagen
                previewArea.appendChild(imgElement);
              };
              reader.readAsDataURL(file);
            });
          }
        }));
      });
  </script> --}}
  @endpush
</x-app-layout>