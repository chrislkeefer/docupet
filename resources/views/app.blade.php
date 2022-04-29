<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://rsms.me/inter/inter.css" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body id="app" class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <div class="flex-shrink">
                    
                </div>
                <div class="w-full flex-grow justify-center flex items-center">
                    <img class="h-10" src="{{ asset('images/brand-logo.png') }}" />
                </div>
                <div class="flex-shrink">
                    
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <pet-form :species-options="@js(\App\Models\PetSpecies::all())" />
        </main>
    </div>
</body>

</html>