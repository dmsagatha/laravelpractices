@props([
  'id' => 'delete-item', // ID único del modal
  'title' => 'Confirmar eliminación',
  'confirmText' => 'Sí, eliminar',
])

<div id="{{ $id }}-modal" class="fixed hidden inset-0 z-50 justify-center items-center size-auto max-h-none max-w-none overflow-y-auto">
  <!-- Fondo oscuro -->
  <div class="fixed inset-0 bg-gray-500/75 transition-opacity"></div>

  <!-- Contenedor del modal -->
  <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
    <div class="relative transform overflow-hidden rounded-lg bg-slate-50 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg dark:bg-gray-800 outline-1 outline-slate-50/10">
      <!-- Header -->
      <div class="bg-slate-50 dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 dark:bg-red-500/10 sm:mx-0 sm:size-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
              <line x1="12" y1="9" x2="12" y2="13"/>
              <line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
          </div>
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-base font-semibold text-gray-900 dark:text-slate-50">{{ $title }}</h3>
            <div class="mt-2">
              <p id="{{ $id }}-message" class="text-base text-gray-500 dark:text-gray-400"></p>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div class="bg-gray-50 dark:bg-gray-700/25 px-4 py-3 sm:flex sm:flex-row-reverse gap-4">
        <button type="button" onclick="closeDeleteModal('{{ $id }}')" class="inline-flex w-full justify-center rounded-md px-3 py-2 bg-slate-50 dark:bg-slate-50/10 text-sm font-semibold text-gray-900 dark:text-slate-50 shadow-xs hover:bg-gray-50 dark:hover:bg-slate-50/20 sm:w-auto">
          Cancelar
        </button>

        <!-- Formulario de eliminación -->
        <form method="POST" id="{{ $id }}-form">
          @csrf
          @method('DELETE')
          <button type="submit" class="inline-flex w-full justify-center rounded-md px-3 py-2 bg-red-600 dark:bg-red-500 text-sm font-semibold text-slate-50 shadow-xs hover:bg-red-500 dark:hover:bg-red-400 sm:ml-3 sm:w-auto">
            {{ $confirmText }}
          </button>
        </form>
      </div>
    </div>
  </div>
</div>