@props([
  'label' => null,
  'name',
  'value' => null,
  'rows' => 4,
])

<div class="space-y-1">
  @if ($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
      {{ $label }}
    </label>
  @endif

  <textarea
    name="{{ $name }}"
    id="{{ $name }}"
    rows="{{ $rows }}"
    {{
      $attributes->merge([
        'class' => 'w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-gray-200 focus:ring-blue-500 focus:border-blue-500',
      ])
    }}
  >
{{ old($name, $value) }}</textarea
  >

  @error($name)
    <p class="text-sm text-red-500">{{ $message }}</p>
  @enderror
</div>

{{-- Uso en formulario --}}
<x-forms.textarea label="Biografía" name="bio" :value="$user->bio ?? null" rows="5" />
