@props([
  'label' => null,
  'name',
  'options' => [],
  'value' => null,
])

<div class="space-y-1">
  @if ($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
      {{ $label }}
    </label>
  @endif

  <select
    name="{{ $name }}"
    id="{{ $name }}"
    {{
      $attributes->merge([
        'class' => 'w-full rounded-lg border-gray-300 dark:border-gray-600
          dark:bg-slate-700 dark:text-gray-200 focus:ring-blue-500 focus:border-blue-500',
      ])
    }}
  >
    <option value="">Seleccione una opción</option>
    @foreach ($options as $key => $text)
      <option value="{{ $key }}" {{ (string) old($name, $value) === (string) $key ? 'selected' : '' }}>
        {{ $text }}
      </option>
    @endforeach
  </select>

  @error($name)
    <p class="text-sm text-red-500">{{ $message }}</p>
  @enderror
</div>
