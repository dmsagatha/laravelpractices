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