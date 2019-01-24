<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} Camps</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
    <script>
        !function(e,n,t,r){
            function o(){try{var e;if((e="string"==typeof this.response?JSON.parse(this.response):this.response).url){var t=n.getElementsByTagName("script")[0],r=n.createElement("script");r.async=!0,r.src=e.url,t.parentNode.insertBefore(r,t)}}catch(e){}}var s,p,a,i=[],c=[];e[t]={init:function(){s=arguments;var e={then:function(n){return c.push({type:"t",next:n}),e},catch:function(n){return c.push({type:"c",next:n}),e}};return e},on:function(){i.push(arguments)},render:function(){p=arguments},destroy:function(){a=arguments}},e.__onWebMessengerHostReady__=function(n){if(delete e.__onWebMessengerHostReady__,e[t]=n,s)for(var r=n.init.apply(n,s),o=0;o<c.length;o++){var u=c[o];r="t"===u.type?r.then(u.next):r.catch(u.next)}p&&n.render.apply(n,p),a&&n.destroy.apply(n,a);for(o=0;o<i.length;o++)n.on.apply(n,i[o])};var u=new XMLHttpRequest;u.addEventListener("load",o),u.open("GET","https://"+r+".webloader.smooch.io/",!0),u.responseType="json",u.send()
        }(window,document,"Smooch","596dbeee3154052401f51a2c");
    </script>
</head>
<body class="font-sans h-screen antialiased">
    
    <nav class="bg-white shadow mb-8 pl-8 md:px-0 flex justify-between">
            
        <div class="p-4 pl-8 flex-1">
            <div class="md:flex items-center">
                <div class="mb-2 md:mb-0">
                    <a href="{{ url('/profile') }}" class="text-brand no-underline font-bold mr-4 text-xl">Code+Design Camps</a>
                </div>
                <div>
                    @auth
                    <a href="/camps">Alle Camps</a> |
                    <a href="/mycamps">Meine Camps</a>
                    @can('isAdmin')| <a href="/admin">Admin</a>@endcan
                    @endauth 

                </div>
            </div>
        </div>
                
        <div class="p-4 ">
            @guest
                <a class="no-underline hover:underline text-grey-darker pr-3 text-sm" href="{{ url('/login') }}">Login</a>
                <a class="no-underline hover:underline text-grey-darker text-sm" href="{{ url('/register') }}">Registrieren</a>
            @else
                <span class="text-grey-darkest text-sm pr-4"><a href="/profile">Dein Profil</a></span>

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
        <script>
            Smooch.init({
                appId: '596dbeee3154052401f51a2c',
                locale: 'de-DE',
                customText: {
                    headerText: 'Wie können wir helfen?',
                    inputPlaceholder: 'Schreib uns…',
                    introAppText: 'Schreib uns hier oder auf Facebook.',
                    introductionText: 'Wir helfen dir bei allen Fragen zur und Problemen mit der Camp-Anmeldung.',
                    sendButtonText: 'Abschicken'
                }
            }).then(function() {
                // Your code after init is complete
            });
        </script>
        @yield('scripts')
</body>
</html>
