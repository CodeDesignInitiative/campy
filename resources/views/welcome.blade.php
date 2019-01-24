<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
    <script>
        !function(e,n,t,r){
            function o(){try{var e;if((e="string"==typeof this.response?JSON.parse(this.response):this.response).url){var t=n.getElementsByTagName("script")[0],r=n.createElement("script");r.async=!0,r.src=e.url,t.parentNode.insertBefore(r,t)}}catch(e){}}var s,p,a,i=[],c=[];e[t]={init:function(){s=arguments;var e={then:function(n){return c.push({type:"t",next:n}),e},catch:function(n){return c.push({type:"c",next:n}),e}};return e},on:function(){i.push(arguments)},render:function(){p=arguments},destroy:function(){a=arguments}},e.__onWebMessengerHostReady__=function(n){if(delete e.__onWebMessengerHostReady__,e[t]=n,s)for(var r=n.init.apply(n,s),o=0;o<c.length;o++){var u=c[o];r="t"===u.type?r.then(u.next):r.catch(u.next)}p&&n.render.apply(n,p),a&&n.destroy.apply(n,a);for(o=0;o<i.length;o++)n.on.apply(n,i[o])};var u=new XMLHttpRequest;u.addEventListener("load",o),u.open("GET","https://"+r+".webloader.smooch.io/",!0),u.responseType="json",u.send()
        }(window,document,"Smooch","596dbeee3154052401f51a2c");
    </script>
</head>
<body class="font-sans font-normal">
    <div class="flex flex-col">
        @if(Route::has('login'))
            <div class="absolute pin-t pin-r mt-4 mr-4">
                @auth
                    <a href="{{ url('/profile') }}" class="no-underline hover:underline text-sm font-normal text-brand-dark uppercase">Profil</a>
                @else
                    <a href="{{ route('login') }}" class="no-underline hover:underline text-sm font-normal text-brand-dark uppercase pr-6">Login</a>
                    <a href="{{ route('register') }}" class="no-underline hover:underline text-sm font-normal text-brand-dark uppercase">Registrieren</a>
                @endauth
            </div>
        @endif

        <div class="flex items-center justify-center mt-8">
            <div class="flex flex-col mt-4 lg">
                <div>
                    <h1 class="text-grey-darker text-center tracking-normal text-7xl mb-6">
                        Code+Design Camps
                    </h1>
                    <div class="text-center mb-8">
                        @auth
                            <a href="{{ route('profile') }}" class="block no-underline hover:underline text-sm text-brand-dark uppercase">Zum Profil</a>
                        @else
                            <a href="{{ route('register') }}" class="mb-4 inline-block no-underline hover:underline text-sm  bg-brand-dark text-white rounded-lg p-4 tracking-wide">Für Camp anmelden</a>
                            <p class="font-normal">Dein x-tes Camp? <a href="{{ route('login') }}" class="text-sm font-normal pr-6">Login</a></p>
                        @endauth
                        <ul class="hidden mt-8 list-reset">
                            <li class="inline pr-8">
                                <a href="https://code.design" class="no-underline hover:underline text-sm font-normal text-brand-dark uppercase" title="Webseite" target="_blank">Webseite</a>
                            </li>
                            <li class="inline pr-8">
                                <a href="https://www.instagram.com/codeunddesign/" class="no-underline hover:underline text-sm font-normal text-brand-dark uppercase" title="Instagram" target="_blank">Instagram</a>
                            </li>
                            <li class="inline pr-8">
                                <a href="https://twitter.com/codeunddesign?lang=de" class="no-underline hover:underline text-sm font-normal text-brand-dark uppercase" title="Twitter" target="_blank">Twitter</a>
                            </li>
                            <li class="inline pr-8">
                                <a href="https://www.youtube.com/channel/UCuT3xJjPZFqQEEpleHBxVuA" class="no-underline hover:underline text-sm font-normal text-brand-dark uppercase" title="Youtube" target="_blank">Youtube</a>
                            </li>
                            <li class="inline pr-8">
                                <a href="https://github.com/CodeDesignInitiative" class="no-underline hover:underline text-sm font-normal text-brand-dark uppercase" title="GitHub" target="_blank">GitHub</a>
                            </li>
                        </ul>
                    </div>
                    <div class="flex table-responsive items-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Stadt</th>
                                    <th scope="col">Von</th>
                                    <th scope="col">Bis</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($camps as $camp)
                                    <tr>
                                        <td class="font-bold"><p class="font-bold">{{ $camp->city }}</p></td>
                                        <td>{{ $camp->from->format('d.m.') }}</td>
                                        <td>{{ $camp->to->format('d.m.Y') }}</td>
                                        <td><p class="flex items-center"><span class="mr-2 inline-block rounded-full w-3 h-3 @if ( $camp->status == 'Warteliste' ) bg-orange-light @else bg-green text-white @endif">&zwnj;</span>{{ $camp->status }}</p></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  
                    <div class="mt-4 text-center leading-loose"><p class="text-xl">Bei Fragen oder Problemen mit der Anmeldung?</p>
                        <p>Wir helfen gerne per <a href="mailto:hello@code.design">Mail</a> oder <a href="javascript:Smooch.open();">Live-Support</a></p>
                    </div>
                    <div class="mt-4 text-center leading-loose">
                        <p class="text-xs">
                            <a href="/impressum">Impressum</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
</body>
</html>
