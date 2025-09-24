<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl leading-tight font-semibold text-gray-800 dark:text-gray-200">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-slate-50 shadow-sm sm:rounded-lg dark:bg-gray-800">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          {{ __("You're logged in!") }}
          <!-- Card Blog -->
          <div class="mx-auto max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
            <div class="group flex h-full flex-col rounded-xl border border-gray-200 bg-slate-50 shadow-2xs dark:border-neutral-700 dark:bg-neutral-900 dark:shadow-neutral-700/70">

              <!-- Alerta de respuesta -->
              @if (Session::has('success'))
                <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-800" role="alert">
                  <span class="font-medium">{{ Session::get('success') }}</span>
                </div>
              @elseif (Session::has('error'))
                <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-800" role="alert">
                  <span class="font-medium">{{ Session::get('error') }}</span>
                </div>
              @endif

              <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex items-center space-x-6">
                  <div class="shrink-0">
                    <img
                      id="preview_img"
                      class="h-16 w-16 rounded-full object-cover"
                      src="{{ asset('images/noavatar.jpeg') }}"
                      alt="Current profile photo"
                    />
                  </div>
                  <label for="avatar" class="block">
                    <span class="sr-only">{{ __('Choose profile photo') }}</span>
                    <input
                      type="file"
                      name="avatar"
                      id="avatar"
                      onchange="loadFile(event)"
                      class="block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:bg-violet-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-violet-700 hover:file:bg-violet-100"
                    />
                  </label>
                </div>
                @error('avatar')
                  <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror

                <div
                  class="mt-auto flex divide-x divide-gray-200 border-t border-gray-200 dark:divide-neutral-700 dark:border-neutral-700"
                >
                  <button
                    type="submit"
                    class="inline-flex w-full items-center justify-center gap-x-2 rounded-es-xl bg-slate-50 px-4 py-3 text-sm font-medium text-gray-800 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 focus:outline-hidden disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                  >
                    Guardar y Redimensionar
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
    <script>
      var loadFile = function (event) {
        var input = event.target;
        var file = input.files[0];
        var type = file.type;

        var output = document.getElementById('preview_img');

        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
          URL.revokeObjectURL(output.src); // free memory
        };
      };
    </script>
  @endpush
</x-app-layout>