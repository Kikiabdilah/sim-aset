<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="d-flex">

        @include('layouts.sidebar')

        {{-- MAIN CONTENT --}}
        <div class="flex-grow-1 bg-light" style="min-height:100vh;">
            @yield('content')
            @include('layouts.topbar')
        </div>
    </div>

    </div>


</body>


</html>