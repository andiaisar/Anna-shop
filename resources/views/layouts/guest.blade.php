<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'E-Commerce') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Custom CSS -->
        <style>
            .bg-gradient {
                background: linear-gradient(to bottom right, #4CAF50, #6d28d9);
            }
            .glass-effect {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.18);
            }
            .custom-gradient {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen custom-gradient flex flex-col justify-center items-center p-4">
            <div class="w-full sm:max-w-md glass-effect rounded-2xl shadow-2xl p-8 space-y-6">
                <div class="flex justify-center">
                    <a href="/" class="transition-transform duration-300 hover:scale-105">
                        <img src="{{ asset('images/img01.png') }}" alt="Logo" class="w-28">
                    </a>
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>