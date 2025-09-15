@props([
    'itemId' => null,
    'itemName' => '',
    'deleteRoute' => '',
    'buttonText' => 'Eliminar',
    'buttonClass' => 'px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition-colors',
    'modalTitle' => 'Confirmar Eliminación',
    'modalMessage' => '¿Estás seguro de que deseas eliminar a :name?',
    'confirmText' => 'Eliminar',
    'cancelText' => 'Cancelar'
])

<button type="button" onclick="showDeleteModal('{{ $itemId }}')" class="{{ $buttonClass }}">
  {{ $buttonText }}
</button>
{{-- <button type="button" onclick="showDeleteModal('{{ $itemId }}')" class="{{ $buttonClass }}" title="{{ $buttonText }}"><i data-lucide="trash-2" class="w-4 h-4"></i>
</button> --}}


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