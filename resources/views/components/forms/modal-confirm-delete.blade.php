@props([
    'itemId' => null,
    'itemName' => '',
    'deleteRoute' => '',
    'title' => 'Confirmar Eliminación',
    'message' => '¿Estás seguro de que deseas eliminar este elemento?',
    'confirmText' => 'Eliminar',
    'cancelText' => 'Cancelar',
])

<div id="confirmDeleteModal-{{ $itemId }}" class="fixed hidden inset-0 z-50 justify-center items-center size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
  <div class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></div>
  <div class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
    <div class="relative transform overflow-hidden rounded-lg bg-slate-50 text-left shadow-xl transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95 dark:bg-gray-800 outline -outline-offset-1 outline-slate-50/10">
      <div class="bg-slate-50 dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 dark:bg-red-500/10 sm:mx-0 sm:size-10">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 text-red-600 dark:text-red-400">
              <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </div>
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-base font-semibold text-gray-900 dark:text-slate-50">{{ $title }}</h3>
            <div class="mt-2">
              <p class="text-base text-gray-500 dark:text-gray-400">
                {!! str_replace(':name', '<span class="font-medium">' . e($itemName) . '</span>', $message) !!}
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 dark:bg-gray-700/25 px-4 py-3 sm:flex sm:flex-row-reverse gap-4">
        <form action="{{ $deleteRoute }}" method="POST" id="deleteForm-{{ $itemId }}">
          @csrf
          @method('DELETE')
          <button type="submit" class="inline-flex w-full justify-center rounded-md px-3 py-2 bg-red-600 dark:bg-red-500 text-sm font-semibold text-slate-50 shadow-xs hover:bg-red-500 dark:hover:bg-red-400 sm:ml-3 sm:w-auto">
            {{ $confirmText }}
          </button>
        </form>

        <button type="button" onclick="hideDeleteModal('{{ $itemId }}')"
          class="inline-flex w-full justify-center rounded-md px-3 py-2 bg-slate-50 dark:bg-slate-50/10 text-sm font-semibold text-gray-900 dark:text-slate-50 shadow-xs inset-ring inset-ring-gray-300 dark:inset-ring-slate-50/5 hover:bg-gray-50 dark:hover:bg-slate-50/20 sm:mt-0 sm:w-auto">
          {{ $cancelText }}
        </button>
      </div>
    </div>
  </div>
</div>