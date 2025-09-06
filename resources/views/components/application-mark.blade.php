@props(['class' => 'h-10 w-10'])

<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Local Palate">
  <!-- Bowl rim -->
  <ellipse cx="64" cy="58" rx="46" ry="10" fill="#ffd1dc"/>
  <!-- Bowl body -->
  <path d="M16 58c0 24 20 44 48 44s48-20 48-44H16z" fill="#ffffff" />
  <path d="M16 58c0 24 20 44 48 44s48-20 48-44" fill="none" stroke="#ec4899" stroke-width="6" stroke-linecap="round"/>
  <!-- Steam -->
  <path d="M48 32c-4 6 6 8 2 14M66 28c-4 6 6 8 2 14M82 34c-4 6 6 8 2 14"
        stroke="#ec4899" stroke-width="4" stroke-linecap="round" fill="none"/>
  <!-- Chopsticks -->
  <path d="M92 20L40 50" stroke="#1f2937" stroke-width="5" stroke-linecap="round"/>
  <path d="M98 24L46 54" stroke="#1f2937" stroke-width="5" stroke-linecap="round"/>
</svg>
