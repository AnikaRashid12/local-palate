<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Local Palate') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire -->
    @livewireStyles
  </head>
  <body class="font-sans antialiased bg-gradient-to-b from-[#FFD1DC] to-[#FFB6C1] min-h-screen flex items-center justify-center p-6">
    {{-- Auth pages slot --}}
    <div class="w-full max-w-md">
      {{ $slot }}
    </div>

    @livewireScripts
  </body>
</html>
