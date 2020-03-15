<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    @stack('css')
    @yield('css')
</head>
<body>
    
    <div class="container-fluid">

        <section class="content-header">
            @yield('content_header')
        </section>

        @yield('content')
    </div>

    @stack('js')
    @yield('js')
</body>
</html>