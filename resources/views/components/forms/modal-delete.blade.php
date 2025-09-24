@props([
  'id' => 'delete-item', // ID único del modal
  'title' => 'Confirmar eliminación',
  'confirmText' => 'Sí, eliminar',
])

<!-- Modal genérico -->
<div id="{{ $id }}-modal" class="bg-opacity-50 fixed inset-0 z-50 hidden items-center justify-center bg-black">
  <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-lg dark:bg-slate-800">
    <h2 class="mb-4 text-lg font-semibold text-slate-800 dark:text-slate-100">{{ $title }}</h2>
    <p id="{{ $id }}-message" class="mb-6 text-sm text-slate-600 dark:text-slate-300"></p>

    <div class="flex justify-end gap-3">
      <button
        type="button"
        onclick="closeDeleteModal('{{ $id }}')"
        class="rounded-md bg-slate-200 px-4 py-2 text-slate-800 hover:bg-slate-300 dark:bg-slate-600 dark:text-slate-100 dark:hover:bg-slate-500"
      >
        Cancelar
      </button>

      <!-- Formulario de eliminación -->
      <form method="POST" id="{{ $id }}-form">
        @csrf
        @method('DELETE')
        <button
          type="submit"
          class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-slate-50 shadow-xs hover:bg-red-500 sm:w-auto dark:bg-red-500 dark:hover:bg-red-400"
        >
          {{ $confirmText }}
        </button>
      </form>
    </div>
  </div>
</div>
