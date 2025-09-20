<div class="modal micromodal-slide" id="{{ $id }}" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="{{ $id }}-title">
      <header class="modal__header">
        <h2 class="modal__title text-lg font-semibold text-gray-800 dark:text-gray-200" id="{{ $id }}-title">
          {{ $title }}
        </h2>
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>

      <main class="modal__content text-gray-600 dark:text-gray-300" id="{{ $id }}-content">
        {{ $slot }}
      </main>

      <footer class="modal__footer flex justify-end gap-2">
        <button class="px-4 py-2 bg-gray-300 dark:bg-gray-700 rounded-md" data-micromodal-close>
          Cancelar
        </button>
        {{ $footer }}
      </footer>
    </div>
  </div>
</div>