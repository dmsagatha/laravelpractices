<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Users') }}
    </h2>
  </x-slot>

  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-slate-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 text-gray-900 dark:text-gray-100">
        <a href="{{ route('users.create') }}" class="relative inline-flex justify-end items-center p-2 mr-2 mb-2 text-blue-600 border border-blue-500 hover:bg-blue-500 hover:text-slate-50 active:bg-blue-600 font-medium rounded-lg outline-none focus:outline-none ease-linear transition-all duration-150">
          <i data-lucide="plus-circle" class=" mr-1"></i>Nuevo Usuario
        </a>
        <table class="w-full mt-6 border border-gray-300 dark:border-gray-600">
          <thead class="bg-gray-200 dark:bg-gray-900">
            <tr class="">
              <th class="p-2">N°</th>
              <th class="p-2">Avatar</th>
              <th class="p-2">Nombre</th>
              <th class="p-2">Correo electrónico</th>
              <th class="p-2">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr class="border-t border-gray-300 dark:border-gray-700 hover:bg-slate-100 dark:hover:bg-slate-700">
                <td class="p-2">{{ $loop->index + 1 }}</td>
                <td class="p-2">
                  <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/default-noavatar.png') }}" alt="avatar" class="w-12 h-12 rounded-full object-cover" />
                </td>
                <td class="p-2">{{ $user->name }}</td>
                <td class="p-2">{{ $user->email }}</td>
                <td class="flex items-center justify-center text-center py-5 gap-4">
                  <!-- Editar -->
                  <a href="{{ route('users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-800 dark:text-blue-400 dark:hover:text-slate-50">
                    <i data-lucide="pencil" class="w-4 h-4"></i>
                  </a>
                  <!-- Eliminar -->
                  <x-forms.button-delete
                      :itemId="$user->id"
                      :itemName="$user->name"
                      :deleteRoute="route('users.destroy', $user)"
                      buttonText="Eliminar"
                  />
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        {{ $users->links() }}
      </div>
    </div>
  </div>

  <!-- Renderizar todos los modales -->
  @stack('modals')
</x-app-layout>