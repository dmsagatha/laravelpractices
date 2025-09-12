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
            <div class="relative z-0 col-span-6 sm:col-span-3 md:col-span-2 mt-2">
            </div>
          </div>

          <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-4">
            {{ isset($user) ? 'Actualizar' : 'Crear' }}
          </button>
        </form>
      </div>
    </div>
  </div>

  @push('scripts')
  @endpush
</x-app-layout>