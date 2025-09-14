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

        <div class="flex gap-5 justify-center">
          <div x-data="{ showModal: false }" x-on:keydown.window.escape="showModal = false">
            <div class="flex justify-center">
              <button x-on:click="showModal = !showModal" class="rounded-lg border border-red-500 bg-red-500 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-red-700 hover:bg-red-700 focus:ring focus:ring-red-200 disabled:cursor-not-allowed disabled:border-red-300 disabled:bg-red-300">Error Modal</button>
            </div>
            <div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-10 bg-secondary-700/50"></div>
            <div x-cloak x-show="showModal" x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
              <div class="mx-auto w-full overflow-hidden rounded-lg bg-white shadow-xl sm:max-w-sm">
                <div class="relative p-5">
                  <div class="text-center">
                    <div class="mx-auto mb-5 flex h-10 w-10 items-center justify-center rounded-full bg-red-100 text-red-500">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                      </svg>
                    </div>
                    <div>
                      <h3 class="text-lg font-medium text-secondary-900">Delete blog post</h3>
                      <div class="mt-2 text-sm text-secondary-500">Are you sure you want to delete this post? This action cannot be undone.</div>
                    </div>
                  </div>
                  <div class="mt-5 flex justify-end gap-3">
                    <button type="button" x-on:click="showModal = false" class="flex-1 rounded-lg border border-gray-300 bg-white px-4 py-2 text-center text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-100 focus:ring focus:ring-gray-100 disabled:cursor-not-allowed disabled:border-gray-100 disabled:bg-gray-50 disabled:text-gray-400">Cancel</button>
                    <button type="button" class="flex-1 rounded-lg border border-red-500 bg-red-500 px-4 py-2 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-red-700 hover:bg-red-700 focus:ring focus:ring-red-200 disabled:cursor-not-allowed disabled:border-red-300 disabled:bg-red-300">Delete</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        

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
                <td class="flex items-stretch justify-center py-5 space-x-2">
                  <!-- Editar -->
                  <a href="{{ route('users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-800 dark:text-blue-400 dark:hover:text-slate-50">
                    <i data-lucide="pencil" class="w-4 h-4"></i>
                  </a>
                  <!-- Eliminar -->
                  <form action="{{ route('users.destroy',$user) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    {{-- <button onclick="return confirm('¿Eliminar usuario?')" class="text-red-500 ml-2">Eliminar</button> --}}
                    <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-delete-modal', {
                      detail: {
                        form: this.closest('form'),
                        title: 'Eliminar usuario',
                        message: '¿Está seguro que desea eliminar a {{ $user->name }}? Esta acción no se puede deshacer.'
                      } }))" class="btn-delete-user text-red-600 dark:text-red-400 ml-2">
                      <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        {{ $users->links() }}
      </div>
    </div>
  </div>

  @push('scripts')
  @endpush
</x-app-layout>