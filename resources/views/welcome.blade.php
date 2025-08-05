<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <title>Local Palate</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
            </style>
        @endif
    </head>
    <body class="bg-gradient-to-b from-[#FFD1DC] to-[#FFB6C1] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
>
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="px-5 py-2 text-pink-700 border border-pink-400 rounded-full hover:bg-pink-100 transition font-medium"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class=" px-5 py-2 text-pink-700 border border-pink-400 rounded-full hover:bg-pink-100 transition font-medium">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0 bg-gradient-to-b from-[#FFD1DC] to-[#FFB6C1]">
        <div class="absolute inset-0 z-0">
          <img src="{{ asset('images/localpalate.png') }}" class="w-full h-full object-cover opacity-30" />
        </div>
            <main class="relative z-10 flex flex-col lg:flex-row w-full max-w-6xl min-h-[80vh]">

    <!-- Left Half: Image -->
                <div class="w-full lg:w-1/2">
                   <img src="{{ asset('images/localpalate.png') }}" alt="Local Palate" class="w-full h-full object-cover rounded-l-xl" />
                </div>

    <!-- Right Half: Title, Quote, Buttons -->
                <div class="w-full lg:w-1/2 bg-gradient-to-b from-[#FFD1DC] to-[#FFB6C1] flex flex-col justify-center items-center p-10 text-center rounded-r-xl">
                   
                 <h1 class="text-6xl font-bold mb-4 text-white">Local Palate</h1>
                 <p class="mb-6 max-w-md font-bold text-2xl text-white">
                     Welcome to Local Palate! 👋 <br />
                     Get ready to sprinkle some joy on your taste buds. <br />
                     We're here to dish out the deets on local eats, one delightful review at a time. What are you hungry for?
                 </p>

                <div class="flex gap-4">
                 <a href="{{ route('login') }}"
                   class="px-6 py-2 bg-pink-600 text-white rounded-full hover:bg-pink-700 transition">
                     Login
                 </a>
                 <a href="{{ route('register') }}"
                   class="px-6 py-2 bg-white text-pink-600 border border-pink-600 rounded-full hover:bg-pink-50 transition">
                     Register
                 </a>
                </div>
        

            </main>
        </div>    
            
                               
                
                    

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
