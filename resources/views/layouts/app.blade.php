<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-brand-lightest h-screen antialiased">

        <nav class="bg-white shadow mb-8 pl-8 md:px-0 flex justify-between">

                        <div class="p-4 pl-8 flex-1">
                            <div class="md:flex">
                                <div class="mb-2 md:mb-0"><a href="{{ url('/home') }}" class="font-bold mr-4 font-blue-light"><img src="{{ asset('img/logo/codedesign.png') }}" height=25></a></div>
                                <div>
                                   @auth
                                    <a href="/camps">Alle Camps</a> |
                                    <a href="/mycamps">Meine Camps</a>
                                   @endauth
                                </div>
                            </div>
                        </div>

                        <div class="p-4 ">
                            @guest
                                <a class="no-underline hover:underline text-grey-darker pr-3 text-sm" href="{{ url('/login') }}">Login</a>
                                <a class="no-underline hover:underline text-grey-darker text-sm" href="{{ url('/register') }}">Registrieren</a>
                            @else
                                <span class="text-grey-darker text-sm pr-4">{{ Auth::user()->name }}</span>

                                <a href="{{ route('logout') }}"
                                    class="no-underline hover:underline text-grey-darker text-sm"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    {{ csrf_field() }}
                                </form>
                            @endguest
                        </div>
        </nav>

        <main class="w-full p-8" id="app">
            @yield('content')
        </main>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
