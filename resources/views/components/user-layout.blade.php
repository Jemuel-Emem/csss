<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CSSS</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

    <style>
        [x-cloak] {
            display: none;
        }
        #logos {
            font-family: "Anton", sans-serif;
            font-weight: 600;
            font-size: 60px;
            font-style: normal;
        }
        #logo {
            font-family: "Anton", sans-serif;
            font-weight: 600;
            font-size: 30px;
            font-style: normal;
        }
        .text-container::after {
            content: '|';
            animation: blink 1s infinite;
        }
        @keyframes blink {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0;
            }
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex-grow: 1;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @wireUiScripts
    @livewireStyles
</head>

<body class="font-sans antialiased bg-no-repeat bg-gradient-to-tr from-emerald-950 via-white to-emerald-100">


    <x-dialog z-index="z-50" blur="md" align="center" />
    <div x-data="{ open: false }" class="relative flex flex-col w-full p-5 mx-auto bg-emerald-900 md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
        <div class="flex flex-row items-center justify-between lg:justify-start">
            <a class="text-lg tracking-tight text-black uppercase focus:outline-none focus:ring lg:text-2xl" href="/">
                <span class="lg:text-lg uppercase focus:ring-0 font-bold text-yellow-600 flex" id="logo">
                    <img src="{{ asset('images/sksu1.png') }}" alt="Violation Photo" class="w-16 h-16">
                    <span class="mt-4 ml-2">CSSS</span>
                </span>
            </a>
            <button @click="open = !open" class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-black focus:outline-none focus:text-black md:hidden">
                <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <nav :class="{'flex': open, 'hidden': !open}" class="flex-col items-center flex-grow hidden md:pb-0 md:flex md:justify-end md:flex-row">
            <div class="inline-flex items-center gap-2 list-none lg:ml-auto">
                <div class="relative flex-shrink-0 ml-5" @click.away="open = false" x-data="{ open: false }">
                    <div>
                        <span class="text-white font-bold uppercase">{{ Auth::user()->name }}</span>
                        <a href="{{ route('logout') }}" class="text-red-500">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div class="relative flex justify-center">
        <div class="w-full max-w-9xl  rounded-lg dark:border-gray-700 p-2 mt-2 overflow-hidden">
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
