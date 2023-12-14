<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link type="image/x-icon" href="/storage/img/favicon.ico" rel="shortcut icon">
    <link type="Image/x-icon" href="/storage/img/favicon.ico" rel="icon">

    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
@if (Auth::check())
    <script>
        window.Laravel = {!!json_encode([
            'isLoggedin' => true,
            'user' => Auth::user()
        ])!!}
    </script>
@else
    <script>
        window.Laravel = {!!json_encode([
            'isLoggedin' => false
        ])!!}
    </script>
@endif
<div id="app"
     class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-white dark:bg-gray-800 text-black dark:text-white">
    <header-line></header-line>
    <sidebar-vue></sidebar-vue>
    <div class="h-full ml-16 mt-14 mb-10 md:ml-52">
        @yield('content')
    </div>
</div>



</body>

</html>
