<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl leading-tight font-semibold text-gray-800 dark:text-gray-200">
      Mensajes a Usuarios ({{ $users->total() ?? $users->count() }})
    </h2>
  </x-slot>

  <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="overflow-hidden bg-slate-50 shadow-sm sm:rounded-lg dark:bg-gray-800">
      <div class="p-6 text-gray-900 dark:text-gray-100">
        <form id="sendForm" action="{{ route('users.send') }}" method="POST">
          @csrf

          <!-- Campo oculto con el mensaje ya formateado -->
          <input type="hidden" name="message" value="Este es el mensaje predeterminado desde user-message.blade.php" />
          
          <table class="mt-6 w-full border border-gray-300 dark:border-gray-600">
            <thead class="bg-gray-200 dark:bg-gray-900">
              <tr>
                <th class="p-2">N°</th>
                <th class="p-2">
                  <p>Enviar mensaje</p>
                  <input type="checkbox" id="selectAll" />
                </th>
                <th class="p-2">Avatar</th>
                <th class="p-2">Nombre</th>
                <th class="p-2">Correo electrónico</th>
                <th class="p-2">Fecha de nacimiento</th>
                <th class="p-2">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr class="border-t border-gray-300 hover:bg-slate-100 dark:border-gray-700 dark:hover:bg-slate-700">
                <td class="p-2 text-center">{{ $loop->iteration }}</td>
                <td class="p-2 text-center">
                    <input type="checkbox" name="users[]" value="{{ $user->id }}" class="userCheckbox" />
                  </td>
                  <td class="p-2">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/default-noavatar.png') }}" alt="avatar" class="h-10 w-10 rounded-full object-cover" />
                  </td>
                  <td class="p-2">{{ $user->name }}</td>
                  <td class="p-2">{{ $user->email }}</td>
                  <td class="text-center">{{ $user->birthdate?->format('Y-m-d') }}</td>
                  <td class="flex items-center justify-center gap-4 py-5 text-center">
                    <!-- Editar -->
                    <a href="{{ route('users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-800 dark:text-blue-400 dark:hover:text-slate-50">
                      <i data-lucide="pencil" class="h-4 w-4"></i>
                    </a>
                    <!-- Eliminar -->
                    <button onclick="openDeleteModal('delete-user', 'usuarios', {{ $user->id }}, 'el usuario {{ $user->name }}')">
                      <i data-lucide="trash-2" class="h-4 w-4 text-red-600 hover:text-red-800 dark:hover:text-red-400"></i>
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <!-- Botón de enviar (oculto al inicio) -->
          <div class="mt-4 hidden" id="sendActions">
            <button type="button" id="openModalBtn" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
              Enviar mensaje a
              <span id="selectedCount">0</span>
              usuarios
            </button>
          </div>
        </form>

        {{ $users->links() }}
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div id="confirmModal" class="bg-opacity-50 fixed inset-0 z-50 hidden items-center justify-center bg-black">
    <div class="w-96 rounded-lg bg-white p-6 shadow-lg dark:bg-gray-800">
      <h2 class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-200">Confirmar envío</h2>
      <p class="mb-6 text-gray-600 dark:text-gray-300">
        ¿Estás seguro de que quieres enviar el mensaje a
        <span id="modalCount" class="font-bold"></span>
        usuarios?
      </p>
      <div class="flex justify-end space-x-2">
        <button
          type="button"
          id="cancelModalBtn"
          class="rounded bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400 dark:bg-gray-600 dark:text-gray-200"
        >
          Cancelar
        </button>
        <button type="button" id="confirmModalBtn" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
          Confirmar
        </button>
      </div>
    </div>
  </div>

  <!-- Alertas -->
  @if (session('success'))
    <div class="mt-4 rounded bg-green-100 p-2 text-green-800">
      {{ session('success') }}
    </div>
  @endif

  @if (session('error'))
    <div class="mt-4 rounded bg-red-100 p-2 text-red-800">
      {{ session('error') }}
    </div>
  @endif

  @push('scripts')
    <script>
      const checkboxes = document.querySelectorAll('.userCheckbox');
      const selectAll = document.getElementById('selectAll');
      const sendActions = document.getElementById('sendActions');
      const selectedCount = document.getElementById('selectedCount');

      const modal = document.getElementById('confirmModal');
      const openModalBtn = document.getElementById('openModalBtn');
      const cancelModalBtn = document.getElementById('cancelModalBtn');
      const confirmModalBtn = document.getElementById('confirmModalBtn');
      const modalCount = document.getElementById('modalCount');
      const form = document.getElementById('sendForm');

      function updateCount() {
        const checked = document.querySelectorAll('.userCheckbox:checked').length;
        if (checked > 0) {
          sendActions.classList.remove('hidden');
          selectedCount.textContent = checked;
        } else {
          sendActions.classList.add('hidden');
          selectedCount.textContent = 0;
        }
      }

      // Seleccionar/Deseleccionar todos
      selectAll.addEventListener('change', function () {
        checkboxes.forEach((cb) => (cb.checked = selectAll.checked));
        updateCount();
      });

      checkboxes.forEach((cb) => cb.addEventListener('change', updateCount));

      // Abrir modal
      openModalBtn.addEventListener('click', function () {
        const checked = document.querySelectorAll('.userCheckbox:checked').length;
        modalCount.textContent = checked;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
      });

      // Cancelar
      cancelModalBtn.addEventListener('click', function () {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
      });

      // Confirmar -> enviar form
      confirmModalBtn.addEventListener('click', function () {
        form.submit();
      });
    </script>
  @endpush
</x-app-layout>