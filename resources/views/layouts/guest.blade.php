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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .background-image {
            background-image: url('{{ asset('images/sksubg.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased relative">
    <div class="background-image"></div>
    <!-- Navigation Bar -->
    <div class="w-full bg-gray-100 bg-opacity-75 py-4 shadow-lg relative z-10">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <a href="/" class="flex items-center space-x-2">
                <img src="{{ asset('images/logocss.png') }}" alt="Logo" class="w-10 h-10">
                <span class="text-xl font-semibold text-gray-700">CSSS</span>
            </a>
            <a href="{{ route('user-dashboard') }}" class="text-gray-700 hover:text-gray-900 underline">Home</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 bg-opacity-75 relative z-10">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
