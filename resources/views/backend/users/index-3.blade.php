<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Users') }}
    </h2>
  </x-slot>

  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-slate-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
      <!-- Modal -->

      <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
      Toggle modal
      </button>

      <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
          <div class="relative p-4 w-full max-w-md max-h-full">
              <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                  <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
                  <div class="p-4 md:p-5 text-center">
                      <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                      </svg>
                      <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                      <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                          Yes, I'm sure
                      </button>
                      <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                  </div>
              </div>
          </div>
      </div>

      <!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
      <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->
      <button command="show-modal" commandfor="dialog" class="rounded-md bg-gray-950/5 px-2.5 py-1.5 text-sm font-semibold text-gray-900 hover:bg-gray-950/10">Open dialog</button>
      <el-dialog>
        <dialog id="dialog" aria-labelledby="dialog-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
          <el-dialog-backdrop class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

          <div tabindex="0" class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
            <el-dialog-panel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95">
              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                  <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 text-red-600">
                      <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </div>
                  <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Deactivate account</h3>
                    <div class="mt-2">
                      <p class="text-sm text-gray-500">Are you sure you want to deactivate your account? All of your data will be permanently removed. This action cannot be undone.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="button" command="close" commandfor="dialog" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto">Deactivate</button>
                <button type="button" command="close" commandfor="dialog" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
              </div>
            </el-dialog-panel>
          </div>
        </dialog>
      </el-dialog>


      <!-- Button to open the modal -->
      <button id="openModalBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Open Modal
      </button>

      <!-- Modal Overlay -->
      <div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
          <!-- Modal Content -->
          <div class="bg-white rounded-lg shadow-xl p-6 w-11/12 md:w-1/3 relative">
              <!-- Close button -->
              <button id="closeModalBtn" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl">
                  &times;
              </button>

              <!-- Modal Header -->
              <h2 class="text-2xl font-bold mb-4">Modal Title</h2>

              <!-- Modal Body -->
              <p class="text-gray-700 mb-6">
                  This is the content of your modal. You can place any information, forms, or other elements here.
              </p>

              <!-- Modal Footer (optional) -->
              <div class="flex justify-end space-x-4">
                  <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                      Cancel
                  </button>
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                      Confirm
                  </button>
              </div>
          </div>
      </div>

      <div id="modal" class="fixed hidden inset-0 z-50 justify-center items-center bg-slate-400 opacity-75">
        <div class="flex justify-center items-center h-full w-full">
          <div class="bg-slate-50 rounded-lg p-8 w-1/2 fade-in modal-content">
            <div class="mb-4">
              <h2 class="text-xl font-bold">Título del Modal</h2>
            </div>
            <div>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit, pariatur dolorem porro sapiente illum iste in iusto odit a praesentium, vel ipsum cum. Quod soluta, inventore quidem ducimus rerum expedita.</p>
            </div>
            <div class="mt-5">
              <button id="closeModal" class="bg-red-500 text-slate-50 px-4 py-2 rounded font-bold">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

      <div class="flex justify-center items-center">
        <button id="openModal" class="bg-blue-500 text-slate-50 px-4 py-2 rounded font-bold">Abril Modal</button>
      </div>



      <div class="p-6 text-gray-900 dark:text-gray-100">
        <a href="{{ route('users.create') }}" class="relative inline-flex justify-end items-center p-2 mr-2 mb-2 text-blue-600 border border-blue-500 hover:bg-blue-500 hover:text-slate-50 active:bg-blue-600 font-medium rounded-lg outline-none focus:outline-none ease-linear transition-all duration-150">
          <i data-lucide="plus-circle" class=" mr-1"></i>Nuevo Usuario
        </a>

        {{-- <div class="w-screen bg-zinc-300 flex flex-col justify-center items-center text-center">
          <div class="container w-9/12 bg-slate-50 px-4 py-5 m-5 rounded-lg">
            <h1 class="text-3xl my-3">Mi Modal con Tailwind CSS 4</h1>
            <P>
              Itaque ullam eos hic ab veritatis, quam maiores, enim corporis quia illo qui sequi libero placeat, recusandae officia! Impedit et fugiat doloribus.
            </P>
            <button type="button" class="bg-orange-400 text-slate-50 text-lg px-2 py-1 rounded-md">Abrir Modal</button>
          </div>
        </div> --}}

        <div class="flex gap-5 justify-center">
          <div x-data="{ showModal: false }" x-on:keydown.window.escape="showModal = false">
            <div class="flex justify-center">
              <button x-on:click="showModal = !showModal" class="rounded-lg border border-red-500 bg-red-500 px-5 py-2.5 text-center text-sm font-medium text-slate-50 shadow-sm transition-all hover:border-red-700 hover:bg-red-700 focus:ring focus:ring-red-200 disabled:cursor-not-allowed disabled:border-red-300 disabled:bg-red-300">Error Modal</button>
            </div>
            <div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-10 bg-secondary-700/50"></div>
            <div x-cloak x-show="showModal" x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
              <div class="mx-auto w-full overflow-hidden rounded-lg bg-slate-50 shadow-xl sm:max-w-sm">
                <div class="relative p-5">
                  <div class="text-center">
                    <div class="mx-auto mb-5 flex h-10 w-10 items-center justify-center rounded-full bg-red-100 text-red-500">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                      </svg>
                    </div>
                    <div>
                      <h3 class="text-lg font-medium text-secondary-900">Delete blog post</h3>
                      <div class="mt-2 text-sm text-secondary-500">Are you sure you want to delete this post? This action cannot be undone.</div>
                    </div>
                  </div>
                  <div class="mt-5 flex justify-end gap-3">
                    <button type="button" x-on:click="showModal = false" class="flex-1 rounded-lg border border-gray-300 bg-slate-50 px-4 py-2 text-center text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-100 focus:ring focus:ring-gray-100 disabled:cursor-not-allowed disabled:border-gray-100 disabled:bg-gray-50 disabled:text-gray-400">Cancel</button>
                    <button type="button" class="flex-1 rounded-lg border border-red-500 bg-red-500 px-4 py-2 text-center text-sm font-medium text-slate-50 shadow-sm transition-all hover:border-red-700 hover:bg-red-700 focus:ring focus:ring-red-200 disabled:cursor-not-allowed disabled:border-red-300 disabled:bg-red-300">Delete</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        

        <table class="w-full mt-6 border border-gray-300 dark:border-gray-600">
          <thead class="bg-gray-200 dark:bg-gray-900">
            <tr class="">
              <th class="p-2">N°</th>
              <th class="p-2">Avatar</th>
              <th class="p-2">Nombre</th>
              <th class="p-2">Correo electrónico</th>
              <th class="p-2">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr class="border-t border-gray-300 dark:border-gray-700 hover:bg-slate-100 dark:hover:bg-slate-700">
                <td class="p-2">{{ $loop->index + 1 }}</td>
                <td class="p-2">
                  <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/default-noavatar.png') }}" alt="avatar" class="w-12 h-12 rounded-full object-cover" />
                </td>
                <td class="p-2">{{ $user->name }}</td>
                <td class="p-2">{{ $user->email }}</td>
                <td class="flex items-stretch justify-center py-5 space-x-2">
                  <!-- Editar -->
                  <a href="{{ route('users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-800 dark:text-blue-400 dark:hover:text-slate-50">
                    <i data-lucide="pencil" class="w-4 h-4"></i>
                  </a>
                  <!-- Eliminar -->
                  <x-forms.button-delete
                      :itemId="$user->id"
                      :itemName="$user->name"
                      :deleteRoute="route('users.destroy', $user)"
                      buttonText="Eliminar"
                  />
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        {{ $users->links() }}
      </div>
    </div>
  </div>

  <!-- Modal https://www.youtube.com/watch?v=sj2BgOKUE9M -->
  {{-- <div class="absolute top-0 left-0 w-screen bg-zinc-700">
    <div>
      <h1>Mi asombroso Modal</h1>
      <div></div>
      <h2>Lorem ipsum dolor sit amet.</h2>
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatem, ipsa?
      </p>
    </div>
  </div>
</div> --}}

  @push('styles')
    <style>
      @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
      }

      .fade-in {
        animation: fadeIn 0.2s ease-out forwards;
      }
    </style>
  @endpush

  @push('scripts')
    {{-- <script>
      document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('modal');
        const openModalBtn = document.getElementById('openModal');
        const closeModalBtn = document.getElementById('closeModal');

        openModalBtn.addEventListener('click', () => {
          modal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', () => {
          modal.classList.add('hidden');
        });
      });
    </script> --}}


  {{-- <script>
      const openModalBtn = document.getElementById('openModalBtn');
      const closeModalBtn = document.getElementById('closeModalBtn');
      const modalOverlay = document.getElementById('modalOverlay');

      openModalBtn.addEventListener('click', () => {
          modalOverlay.classList.remove('hidden');
      });

      closeModalBtn.addEventListener('click', () => {
          modalOverlay.classList.add('hidden');
      });

      // Close modal when clicking outside the content
      modalOverlay.addEventListener('click', (e) => {
          if (e.target === modalOverlay) {
              modalOverlay.classList.add('hidden');
          }
      });
  </script> --}}
  @endpush

  <!-- Renderizar todos los modales -->
  @stack('modals')
</x-app-layout>