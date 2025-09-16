<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Users') }}
    </h2>
  </x-slot>

  <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="overflow-hidden bg-slate-50 shadow-sm sm:rounded-lg dark:bg-gray-800">
      <div class="p-6 text-gray-900 dark:text-gray-100">
        <a href="{{ route('users.create') }}"
          class="relative mb-2 mr-2 inline-flex items-center justify-end rounded-lg border border-blue-500 p-2 font-medium text-blue-600 outline-none transition-all duration-150 ease-linear hover:bg-blue-500 hover:text-slate-50 focus:outline-none active:bg-blue-600">
          <i data-lucide="plus-circle" class="mr-1"></i>Nuevo Usuario
        </a>
        <table class="mt-6 w-full border border-gray-300 dark:border-gray-600">
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
              <tr class="border-t border-gray-300 hover:bg-slate-100 dark:border-gray-700 dark:hover:bg-slate-700">
                <td class="p-2">{{ $loop->index + 1 }}</td>
                <td class="p-2">
                  <img
                    src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/default-noavatar.png') }}"
                    alt="avatar" class="h-12 w-12 rounded-full object-cover" />
                </td>
                <td class="p-2">{{ $user->name }}</td>
                <td class="p-2">{{ $user->email }}</td>
                <td class="flex items-center justify-center gap-4 py-5 text-center">
                  <!-- Editar -->
                  <a href="{{ route('users.edit', $user) }}"
                    class="text-indigo-600 hover:text-indigo-800 dark:text-blue-400 dark:hover:text-slate-50">
                    <i data-lucide="pencil" class="h-4 w-4"></i>
                  </a>
                  <!-- Eliminar -->
                  <button onclick="openDeleteModal('delete-user', 'usuarios', {{ $user->id }}, 'el usuario {{ $user->name }}')">
                    <i data-lucide="trash-2" class="w-4 h-4 text-red-600 hover:text-red-800 dark:hover:text-red-400"></i>
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        {{ $users->links() }}
      </div>
    </div>
  </div>



<!-- Modal genérico -->
<x-forms.modal-delete id="delete-user" title="Eliminar usuario" confirm-text="Sí, eliminar"/>

  <!-- Modal reutilizable -->
  {{-- <x-forms.modal-confirm-delete id="delete-user" 
      title="Eliminar Usuario"
      message="¿Seguro que deseas eliminar este usuario?"
      route-base="usuarios"
      confirm-text="Sí, eliminar"
      cancel-text="Cancelar" /> --}}

  @push('scripts')
    <script>
      function openDeleteModal(id, resource, itemId, itemName) {
        const modal = document.getElementById(`${id}-modal`);
        const message = document.getElementById(`${id}-message`);
        const form = document.getElementById(`${id}-form`);

        // Mensaje dinámico
        message.textContent = `¿Seguro que deseas eliminar ${itemName}?`;

        // Acción dinámica del form
        form.action = `/${resource}/${itemId}`;

        // Mostrar modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
      }

      function closeDeleteModal(id) {
        const modal = document.getElementById(`${id}-modal`);
        modal.classList.remove('flex');
        modal.classList.add('hidden');
      }

      // Cerrar modal clicando fuera del contenido
      document.addEventListener('click', function(e) {
        document.querySelectorAll('[id$="-modal"]').forEach(modal => {
          if (!modal.classList.contains('hidden') && e.target === modal) {
            closeDeleteModal(modal.id.replace('-modal', ''));
          }
        });
      });
    </script>
  @endpush

  <!-- Renderizar todos los modales -->
  {{-- @stack('modals') --}}
</x-app-layout>