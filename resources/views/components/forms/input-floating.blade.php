@props([
  'label' => null,
  'name',
  'type' => 'text',
  'value' => null,
])

<input
  type="{{ $type }}"
  name="{{ $name }}"
  id="{{ $name }}"
  value="{{ old($name, $value) }}"
  {{ $attributes->merge(['class' => 'block py-2.5 px-0 w-full text-sm text-slate-800 dark:text-slate-50 bg-transparent border-0 border-b-2 border-slate-300 appearance-none dark:border-slate-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer']) }}
  placeholder=" "
/>

<label
  for="{{ $name }}"
  {{ $attributes->merge(['class' => 'peer-focus:font-medium absolute text-sm text-slate-700 dark:text-slate-300 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-200 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8']) }}
>
  {{ $label }}
</label>

@error($name)
  <p class="text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
@enderror
