<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Quote Quiz')</title>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite([
        'resources/css/app.css',
        'resources/css/quiz.css',
        'resources/js/app.js',
        'resources/js/questionnaires.js'])
</head>
<body>
    <h1 class="text-2xl font-bold mb-4 text-center">@yield('title')</h1>
    <br>

    <div class="container">
    @section('content')
        This is the master sidebar.
    @show
    </div>
    
</body>
</html>