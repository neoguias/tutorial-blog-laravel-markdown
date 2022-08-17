<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Edu Lazaro')</title>

        @hasSection('description')
            <meta name="description" content="@yield('description')">
        @endif

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body class="w-full">
        <header class="z-50 flex-none text-sm font-semibold max-w-screen-2xl  mx-auto px-4 sm:px-6 lg:px-8">
            <nav>
                <div class="relative flex items-center py-[2.125rem] text-base">
                    <a class="mr-auto flex-none" href="{{ route('home') }}">Edu Lazaro</a>
                    <div class="lg:flex lg:items-center">
                        <a class="ml-8" href="{{ route('home') }}">Home</a>
                        <a class="ml-8" href="{{ route('blog') }}">Blog</a>
                    </div>
                </div>
            </nav>
        </header>
        <main class="mt-8 max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="container ">
                @yield('content')
            </div>
        </main>
    </body>
</html>
