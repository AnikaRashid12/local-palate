@props(['disabled' => false])

<button {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
  'type' => 'submit',
  'class' =>
    'inline-flex items-center px-6 py-2 rounded-full text-white text-sm font-semibold
     bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-300
     disabled:opacity-50 disabled:cursor-not-allowed transition'
])->toHtml() !!}>
  {{ $slot }}
</button>

