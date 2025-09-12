<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Users') }}
    </h2>
  </x-slot>

  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-slate-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 text-gray-900 dark:text-gray-100">
        <a href="{{ route('users.create') }}" class="bg-blue-500 text-slate-50 px-4 py-2 rounded">Nuevo Usuario</a>
        <table class="w-full mt-6 border border-gray-300 dark:border-gray-600">
          <thead class="bg-gray-200 dark:bg-gray-900">
            <tr class="">
              <th class="p-2">Avatar</th>
              <th class="p-2">Nombre</th>
              <th class="p-2">Email</th>
              <th class="p-2">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr class="border-t border-gray-300 dark:border-gray-700 hover:bg-slate-100 dark:hover:bg-slate-700">
              <td class="p-2">
                <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/default-noavatar.png') }}" alt="avatar" class="w-12 h-12 rounded-full object-cover" />
              </td>
              <td class="p-2">{{ $user->name }}</td>
              <td class="p-2">{{ $user->email }}</td>
              <td class="p-2">
                <a href="{{ route('users.edit',$user) }}" class="text-blue-500">Editar</a>
                <form action="{{ route('users.destroy',$user) }}" method="POST" class="inline">
                  @csrf @method('DELETE')
                  <button onclick="return confirm('¿Eliminar?')" class="text-red-500 ml-2">Eliminar</button>
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
</x-app-layout>