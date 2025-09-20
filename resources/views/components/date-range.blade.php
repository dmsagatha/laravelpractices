@props([
	'id',
	'name',
	'label' => null,
	'value' => null,
	'min' => null,
	'max' => null,
])

<div class="mb-4">
  @if ($label)
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
      {{ $label }}
    </label>
  @endif

  <input type="text" id="{{ $id }}" name="{{ $name }}" value="{{ old($name, $value) }}"
    data-min="{{ $min }}" data-max="{{ $max }}"
    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:border-gray-600 dark:bg-slate-800 dark:text-gray-100">

  @error($name)
    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
  @enderror
</div>