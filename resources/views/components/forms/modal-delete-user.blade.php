@props([
  'id' => 'delete-item', // ID único del modal
  'title' => 'Confirmar eliminación',
  'confirmText' => 'Sí, eliminar',
])

<div id="{{ $id }}-modal" class="fixed hidden inset-0 z-20 justify-center items-center size-auto max-h-none max-w-none overflow-y-auto dark:bg-slate-900/70 bg-slate-500/70">
  <div class="relative transform overflow-hidden bg-slate-50 dark:bg-slate-800 sm:w-full sm:max-w-lg text-left sm:my-8 rounded-lg shadow-xl transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200">
    <!-- Dos columnas - flex -->
    <div class="bg-slate-50 dark:bg-slate-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
      <div class="sm:flex sm:items-start">
        <!-- Icono warning -->
        <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 dark:bg-red-500/10 sm:mx-0 sm:size-10">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true" class="size-6 text-red-600 dark:text-red-400">
            <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>
        <!-- Título y párrafo -->
        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
          <h3 class="text-slate-900 dark:text-slate-50 text-base font-semibold">{{ $title }}</h3>
          <div class="mt-2">
            <p id="{{ $id }}-message" class="text-slate-600 dark:text-slate-400 text-sm"></p>
          </div>
        </div>
      </div>
    </div>
    <!-- Botones -->
    <div class="bg-slate-200/60 dark:bg-slate-700/50 px-6 py-3 flex justify-end items-center gap-4">
      <button onclick="closeDeleteModal('{{ $id }}')" type="button" class="bg-slate-50 text-slate-900 border border-slate-300 focus:outline-none hover:bg-slate-100 focus:ring-4 focus:ring-slate-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-slate-800 dark:text-slate-50 dark:border-slate-600 dark:hover:bg-slate-700 dark:hover:border-slate-600 dark:focus:ring-slate-700">
        Cancelar
      </button>

      <!-- Formulario de eliminación -->
      <form method="POST" id="{{ $id }}-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-700 text-slate-50 focus:outline-none hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
          {{ $confirmText }}
        </button>
    </div>
  </div>
</div>