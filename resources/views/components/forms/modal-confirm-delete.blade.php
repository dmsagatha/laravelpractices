<div
  x-data="{ open: false, form: null }"
  x-on:open-delete-modal.window="open = true; form = $event.detail.form"
  x-show="open"
  x-transition
  class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 dark:bg-black/50"
  style="display: none;"
>
  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-sm mx-4 p-6" @click.away="open = false; form = null;">
    <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $title ?? '¿Estás seguro?' }}</h2>
    <p class="text-gray-700 dark:text-gray-300 mb-6">{{ $slot ?? '¿Deseas eliminar este registro? Esta acción no se puede deshacer.' }}</p>
    <div class="flex justify-end gap-2">
      <button type="button" class="px-4 py-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100" @click="open = false; form = null;">
        Cancelar
      </button>
      <button type="button" class="px-4 py-2 rounded bg-red-600 dark:bg-red-500 text-white" @click="if(form) form.submit(); open = false; form = null;">
        Eliminar
      </button>
    </div>
  </div>
</div>