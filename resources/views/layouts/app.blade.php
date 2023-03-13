<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}| @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body>

    {{-- not showing in login or register pages --}}
    @if ( request()->is('*login*') || request()->is('*register*') || request()->is('*tag_register*') || request()->is('*verify*') || request()->is('*password/reset*') || request()->is('*password/email*') || request()->is('*password/confirm*'))
    @else
    <div class="ss-container">
        <div class="row" style="height: 100%">
            <div class="col-2 p-0">
                {{-- side bar --}}
                <div class="ss-sidebar">
                @include('layouts.side')
                </div>
            </div>
            <div class="col-10 p-0">
                <div class="ss-main">
    @endif

                        {{-- content --}}
                        <div class="container-fluid p-0">
                            <div class="row">
                                    @yield('content')
                            </div>
                        </div>

            {{-- not showing in login or register pages --}}
            @if ( request()->is('*login*') || request()->is('*register*') || request()->is('*tag_register*') || request()->is('*verify*') || request()->is('*password/reset*') || request()->is('*password/email*') || request()->is('*password/confirm*'))
            @else
                    </div>
            </div>
        </div>
    </div>
    @endif

</body>

</html>
