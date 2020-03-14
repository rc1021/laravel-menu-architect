<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    @include('menu_architect::plugins', ['type' => 'css'])
    @yield('css')
</head>
<body>
    <div class="container-fluid">
        @yield('content')
    </div>

    @include('menu_architect::plugins', ['type' => 'js'])
    @yield('js')
</body>
</html>