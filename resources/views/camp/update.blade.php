@extends('layouts.app')

@section('content')

<div class="ml-4 mb-4">
    <h2>Deine Camp-Teilnahme</h2>

    @isset($camp)
    {{ $camp->city }}, {{ $camp->from->format('d.m.Y') }} bis {{ $camp->to->format('d.m.Y') }}, {{$camp->shortcode }}
    @endisset

    <div class="mt-4 -ml-4 bg-white rounded-lg p-2 lg:w-2/3">
        <a href="#status">Status</a> |
        <a href="#data">Personendaten</a> |
        <a href="#reqs">Laptop/Beitrag</a> |
        <a href="#cancel">Absage</a>
    </div>

    <div class="-ml-4 p-4 mt-2 bg-grey-lighter lg:w-2/3 shadow" id="status">
        <h3 class="mb-6">Anmeldestatus</h3>

        <div class="mb-4 w-1/3">
            @component('components.status_camp', ['camp' => $camp->pivot->status])
            @endcomponent
        </div>

        @if ($camp->pivot->status == 'registered' and $camp->pivot->contribution == 'payer')

            <p>Nächster Schritt: Um deine Anmeldung zu bestätigen, tätige bitte folgende Überweisung(en) so schnell möglich.</p>
            <p class="text-sm">Bitte: Unbedingt den Verwendungszweck 1:1 kopieren. Abweichungen verursachen extrem viel unnötige manuelle Arbeit.</p>

            <h4 class="mt-4">Unkostenbeitrag</h4>
            <ul class="leading-normal mb-4">
                <li>Empfänger: Code+Design Initiative e.V.</li>
                <li><em>IBAN:</em> DE24100500000190607629</li>
                <li>BIC: <em>BELADEBEXXX</em></li>
                <li>Betrag: {{ $camp->contribution }}€</li>
                <li><em>Verwendungszweck:</em> Unkostenbeitrag {{ $user->firstname }} {{ $user->lastname }} {{ $camp->shortcode }}</li>
            </ul>

            @if ($camp->pivot->laptop == 'payer')
                <h4 class="mt-4">Laptop</h4>
                <ul class="leading-normal mb-4">
                    <li>Empfänger: Code+Design Initiative e.V.</li>
                    <li><em>IBAN:</em> DE24100500000190607629</li>
                    <li>BIC: <em>BELADEBEXXX</em></li>
                    <li>Betrag: {{ $camp->laptop }}</li>
                    <li><em>Verwendungszweck:</em> Laptop Unkostenbeitrag {{ $user->firstname }} {{ $user->lastname }} {{ $camp->shortcode }}</li>
                </ul>
            @endif


        @elseif ($camp->pivot->status == 'registered' and $camp->pivot->laptop == 'payer')

            <p>Nächster Schritt: Um deine Anmeldung zu bestätigen, tätige bitte folgende Überweisung bis zum <em>{{ $camp->from->subMonth(1)->format('d.m.Y') }}</em> wie folgt.</p>
            <p class="text-sm">Bitte: Unbedingt den Verwendungszweck 1:1 kopieren. Abweichungen verursachen extrem viel unnötige manuelle Arbeit.</p>

            <h4 class="mt-4">Laptop</h4>
            <ul class="leading-normal mb-4">
                <li>Empfänger: Code+Design Initiative e.V.</li>
                <li><em>IBAN:</em> DE24100500000190607629</li>
                <li>BIC: <em>BELADEBEXXX</em></li>
                <li>Betrag: {{ $camp->laptop }}</li>
                <li><em>Verwendungszweck:</em> Laptop Unkostenbeitrag {{ $user->firstname }} {{ $user->lastname }} {{ $camp->shortcode }}</li>
            </ul>
        @endif

    </div>

</div>

@if ($errors->any())
    <div class="bg-yellow rounded-lg p-4">
        Bitte alle Boxen markieren und Felder richtig ausfüllen.
    </div>
@endif

<form action="{{route('camp', [$camp->id])}}" method="post">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <div class="bg-grey-lighter shadow p-4 rounded lg:w-2/3" id="data">
        <p class="font-bold mb-4">Diese Daten von dir kennen wir schon…</p>
        <div class="flex">
            <div class="w-1/2">
                <label for="firstname">Vorname</label><br>
                <input name="firstname" class="p-2 w-full mt-2" type="text" value="{{ $user->firstname }}">
            </div>
            <div class="w-1/2 pl-2">
                <label for="lastname">Nachname</label>
                <input name="lastname" class="p-2 w-full mt-2" type="text" value="{{ $user->lastname }}" readonly>
            </div>
        </div>
        <div>
            <div class="flex mt-4"><div class="w-1/2">
                <label for="birthdate">Geburtstag</label>
                <input name="birthdate" class="p-2 w-full mt-2" type="date" value="{{ $user->birthdate->format('Y-m-d') }}" readonly>
            </div>
            <div class="w-1/2 pl-2">
                <label for="birthdate">Ernährung</label>
                <input name="diet" class="p-2 w-full pb-4 mt-2" type="text" value="{{ $user->diet }}" readonly>
            </div>
        </div>
    </div>
    <p class="mt-4">Fehler entdeckt? Bitte <a href="/home" target="_blank">hier</a> korrigieren!</p>
</div>

<div class="lg:w-2/3 bg-grey-lighter p-4 mt-8" id="reqs">
    <h3 class="mt-8">Laptop/Unkostenbeitrag</h3>
    <div class="mt-2">
        <label for="contribution">Unkostenbeitrag</label><br>
        <div class="relative">
            <select name="contribution" class="mt-2 block appearance-none w-full bg-white border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded">
                <option value="payer" @if($camp->pivot->contribution == 'payer')selected @endif>Ich zahle Unkostenbeitrag (siehe Webseite)</option>
                <option value="waiver" @if($camp->pivot->contribution == 'waiver')selected @endif>Ich kann den Unkostenbeitrag gerade nicht zahlen</option>
            </select>
            <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current h-4 w-4"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path></svg></div>
        </div>
    </div>
    
    <div class="mt-2">
        <label for="laptop">Laptop</label><br>
        <div class="relative">
            <select name="laptop" class="mt-2 block appearance-none w-full bg-white border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded">
                <option value="own" @if ($camp->pivot->laptop == 'own') selected @endif>Nein, ich nutze eigenen Laptop</option>
                @if ($camp->laptop_free === 1)
                    <option value="winner" @if ($camp->pivot->laptop == 'winner') selected @endif>Ja, ich will kostenlosen Laptop ausleihen</option>
                @else
                    <option value="payer" @if ($camp->pivot->laptop == 'payer' or $camp->pivot->laptop == 'paid') selected @endif>Ja, ich will Laptop ausleihen (Details siehe Webseite)</option>
                    <option value="waiver" @if ($camp->pivot->laptop == 'waiver') selected @endif>Ja, ich leihe Laptop, kann aber den Unkostenbeitrag nicht zahlen</option>
                @endif 
            </select>
            <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current h-4 w-4"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path></svg>
            </div>
        </div>
    
        <div class="mt-4"><label for="comment">Sonstiges</label><br>
            <textarea name="comment" id="" rows="10" class="w-full mt-2 p-2" placeholder="Alles, was sonst noch für deine Anmeldung wichtig ist: Allergien, Besonderheiten, sonstige Kommentare">{{ $camp->pivot->comment }}</textarea>
        </div>
    </div>
</div>
<div class="bg-grey-lighter mt-8 p-4 rounded-lg shadow lg:w-2/3">
    <h3 id="cancel">Absage</h3>
        <input type="hidden" name="camp" value="{{ $camp->id }}">
        <input type="hidden" name="user" value="{{ $user->id }}">
        <div>
            <input type="checkbox" name="cancel" class="mt-8">
            <span class="text-red">Ich muss leider absagen, weil…</span>
            <textarea name="reason_for_cancellation" id="" rows="10" class="w-full mt-2 p-2">{{ $camp->pivot->reason_for_cancellation }}</textarea>
        </div>
    </div>
    <input type="submit" value="Ändern/Absagen" class="mt-4 bg-brand p-2 text-white shadow">
</form>
@endsection

@section('scripts')
<script>
    var app = new Vue({
        el: '#app',
        data: {
            message: 'Hello Vue!'
        }
    })
</script>
@endsection