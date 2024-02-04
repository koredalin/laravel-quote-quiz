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
        'resources/js/questionnaires/questionnaires.js',
        'resources/js/questionnaires/personal_data_local.js'])
</head>
<body>

    <div class="container">
    @section('content')
        This is the master sidebar.
    @show
    </div>
    
</body>
</html>