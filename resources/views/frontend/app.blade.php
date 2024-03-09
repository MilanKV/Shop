<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/sass/frontend/app.scss')
</head>

<body>
    <div id="app">
        <div class="main">
            {{-- Page Content --}}
            @yield('content')
        </div>
    </div>
    {{-- @vite('resources/js/app.js') --}}
</body>

</html>
