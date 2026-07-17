<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background-color: #1a1a2e;
                color: #e2e8f0;
            }
            .gym-nav {
                background-color: #16213e !important;
                border-bottom: 1px solid #0f3460 !important;
            }
            .gym-header {
                background-color: #16213e !important;
                border-bottom: 1px solid #0f3460 !important;
            }
            .gym-card {
                background-color: #16213e !important;
                border-color: #0f3460 !important;
            }
            .gym-text-primary { color: #e2e8f0 !important; }
            .gym-text-secondary { color: #94a3b8 !important; }
            .gym-dropdown {
                background-color: #16213e !important;
                border: 1px solid #0f3460 !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen" style="background-color: #1a1a2e;">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="gym-header shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>