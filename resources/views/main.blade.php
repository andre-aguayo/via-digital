<!DOCTYPE html>
<html lang="pt-br">

<head>
    @include('partials.head')
    @yield('head-tags')
</head>

<body class="antialiased">
    @if (!Route::is(['login', 'cadastro', 'error-404', 'error-500']))
        @include('partials.header')
    @endif

    @yield('content')
</body>

@include('partials.footer')

@yield('script')

</html>
