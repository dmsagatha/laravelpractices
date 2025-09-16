@props([
    'itemId' => null,
    'itemName' => '',
    'deleteRoute' => '',
    'buttonText' => 'Eliminar',
    'buttonClass' => 'w-11 h-11 rounded-lg flex items-center justify-center cursor-pointer transition-all duration-500',
    'modalTitle' => 'Confirmar Eliminación',
    'modalMessage' => '¿Estás seguro de eliminar a :name?',
    'confirmText' => 'Eliminar',
    'cancelText' => 'Cancelar'
])

<button type='button' onclick="showDeleteModal('{{ $itemId }}')" class={{ $buttonClass }}' title="{{ $buttonText }}">
  <i data-lucide="trash-2" class="w-4 h-4 text-red-600 hover:text-red-800 dark:hover:text-red-400"></i>
</button>


@push('modals')
  <x-forms.modal-confirm-delete
      :itemId="$itemId"
      :itemName="$itemName"
      :deleteRoute="$deleteRoute"
      :title="$modalTitle"
      :message="$modalMessage"
      :confirmText="$confirmText"
      :cancelText="$cancelText"
  />
@endpush