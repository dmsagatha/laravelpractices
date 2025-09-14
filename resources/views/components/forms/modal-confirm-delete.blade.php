@props([
    'itemId' => null,
    'itemName' => '',
    'deleteRoute' => '',
    'title' => 'Confirmar Eliminación',
    'message' => '¿Estás seguro de que deseas eliminar este elemento?',
    'confirmText' => 'Eliminar',
    'cancelText' => 'Cancelar',
])

<div id="confirmDeleteModal-{{ $itemId }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 items-center justify-center hidden z-50">
  <div class="bg-slate-50 dark:bg-gray-800 rounded-lg p-6 w-96 mx-4">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
      {{ $title }}
    </h3>

    <p class="text-gray-600 dark:text-gray-400 mb-6">
      {!! str_replace(':name', '<span class="font-medium">' . e($itemName) . '</span>', $message) !!}
    </p>

    <div class="flex justify-end space-x-3">
      <button type="button" onclick="hideDeleteModal('{{ $itemId }}')"
        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 dark:bg-gray-600 dark:text-gray-300 transition-colors">
        {{ $cancelText }}
      </button>

      <form action="{{ $deleteRoute }}" method="POST" id="deleteForm-{{ $itemId }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-4 py-2 bg-red-600 text-slate-50 rounded hover:bg-red-700 transition-colors">
          {{ $confirmText }}
        </button>
      </form>
    </div>
  </div>
</div>



{{-- <div
  x-data="{ open: false, form: null }"
  x-on:open-delete-modal.window="open = true; form = $event.detail.form"
  x-show="open"
  x-transition
  class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 dark:bg-black/50"
  style="display: none;"
>
  <div class="bg-slate-50 dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-sm mx-4 p-6" @click.away="open = false; form = null;">
    <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $title ?? '¿Estás seguro?' }}</h2>
    <p class="text-gray-700 dark:text-gray-300 mb-6">{{ $slot ?? '¿Deseas eliminar este registro? Esta acción no se puede deshacer.' }}</p>
    <div class="flex justify-end gap-2">
      <button type="button" class="px-4 py-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100" @click="open = false; form = null;">
        Cancelar
      </button>
      <button type="button" class="px-4 py-2 rounded bg-red-600 dark:bg-red-500 text-slate-50" @click="if(form) form.submit(); open = false; form = null;">
        Eliminar
      </button>
    </div>
  </div>
</div> --}}
