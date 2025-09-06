<div class="mx-auto text-center">
  <div class="flex justify-center mb-6">
    <x-authentication-card-logo class="h-20 w-20" />
  </div>

  {{-- Soft pink glassy panel instead of solid white --}}
  <div {{ $attributes->merge(['class' => 'bg-pink-200/40 backdrop-blur-md shadow-lg rounded-2xl p-8']) }}>
    {{ $slot }}
  </div>
</div>
