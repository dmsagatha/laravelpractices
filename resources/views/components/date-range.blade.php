<div class="mb-4">
  @if ($label)
    <label for="{{ $id }}" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
      {{ $label }}
    </label>
  @endif

  <input type="text" id="{{ $id }}" name="{{ $name }}" value="{{ old($name, $value) }}"
    class="flatpickr-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-slate-800 dark:text-slate-100"
    data-min="{{ $min }}" data-max="{{ $max }}">

  @error($name)
    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
  @enderror
</div>
