@extends('layouts.app')

@section('content')
<div class="ml-4 mb-4">
    <h2>Für Camp anmelden</h2>

    @isset($camp)
    {{ $camp->city }}, {{ $camp->from->format('d.m.') }} bis {{ $camp->to->format('d.m.Y') }}, Camp-Code: <code>{{ $camp->shortcode }}</code>
    @endisset
</div>

@if ($errors->any())
    <div class="bg-yellow rounded-lg p-4">
        Bitte alle Boxen markieren und Felder richtig ausfüllen.
    </div>
@endif

@if ( $camp->status == 'Warteliste' )
    <div class="bg-yellow rounded-lg p-4 lg:w-2/3 mb-4">
        <span class="font-bold">Warteliste:</span>
        Das Camp ist aktuell ausgebucht. Du kannst dich aber auf der Warteliste eintragen.
        Du rutscht automatisch nach, sobald Plätze frei werden.
    </div>
@endif

<form action="{{route('camp', [$camp])}}" method="post">
    {{ csrf_field() }}
    
    <div class="bg-grey-lighter shadow p-4 rounded lg:w-2/3">
        <p class="font-bold mb-4">Diese Daten von dir kennen wir schon…</p>
            <div class="flex">
                <div class="w-1/2">
                    <label for="firstname">Vorname</label><br>
                    <input name="firstname" class="p-2 w-full mt-2" type="text" value="{{ $user->firstname }}">
                </div>
                <div class="w-1/2 pl-2">
                    <label for="lastname">Nachname</label><br>
                    <input name="lastname" class="p-2 w-full mt-2" type="text" value="{{ $user->lastname }}" readonly>
                </div>
            </div>
            <div>
                <div class="flex mt-4"><div class="w-1/2">
                    <label for="birthdate">Geburtstag</label>
                    <input name="birthdate" class="p-2 w-full mt-2" type="date" value="{{ $user->birthdate->format('Y-m-d') }}" readonly>
                </div>
                
                <div class="w-1/2 pl-2">
                    <label for="birthdate">Ernährung</label><br>
                    <input name="diet" class="p-2 w-full pb-4 mt-2" type="text" value="{{ $user->diet }}" readonly>
                </div>
            </div>
        </div>
        <p class="mt-4">Fehler entdeckt? Bitte <a href="/home" target="_blank">hier</a> korrigieren!</p>
    </div>

    <div class="p-4 bg-grey-lighter shadow lg:w-2/3 mt-8">
        <p class="font-bold mb-4">Diese Daten brauchen wir noch.</p>
    
        <div class="mt-2">
            <label for="contribution">Unkostenbeitrag</label>
            <div class="relative">
                <select name="contribution" class="mt-2 block appearance-none w-full bg-white border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded">
                    <option value="payer">Ich zahle Unkostenbeitrag (siehe Webseite)</option>
                    <option value="waiver">Ich kann den Unkostenbeitrag gerade nicht zahlen</option>
                </select>
                <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current h-4 w-4"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path></svg>
                </div>
            </div>
        </div>

        <div class="mt-2">
            <label for="laptop">Laptop</label>
            <div class="relative">
                <select name="laptop" class="mt-2 block appearance-none w-full bg-white border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded">
                    <option value="own" selected>Nein, ich nutze eigenen Laptop</option>
                    @if ($camp->laptop_free === 1)
                        <option value="winner">Ja, ich will kostenlosen Laptop ausleihen</option>
                    @else
                        <option value="payer">Ja, Ich will Laptop gegen Gebühr ausleihen</option>
                        <option value="waiver">Ja, ich brauche Laptop, kann aber Unkostenbeitrag nicht zahlen</option>
                    @endif      
                </select>
                <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current h-4 w-4"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path></svg>
                </div>
            </div>

            <div class="mt-4">
                <label for="comment">Sonstiges</label>
                <textarea name="comment" id="" rows="10" class="w-full mt-2 p-2" placeholder="Alles, was sonst noch für deine Anmeldung wichtig ist: Allergien, Besonderheiten, sonstige Kommentare"></textarea>
            </div>
        </div>
    </div>
    <div class="mt-4 ml-4">
        <p>
            <input type="checkbox" name="tos" value="1">
            <a href="/teilnahmebedingungen" target="_blank">Teilnahmebedingungen</a> akzeptieren
        </p>
        <p class="mt-2">
            <input type="checkbox" name="consent" value="1" >
            <a href="/datenschutz" target="_blank">Einwilligung der Speicherung personenbezogener Daten</a> erteilen
        </p>
    </div>

    <div class="mt-8">
        <input type="submit" value="Anmelden" class="bg-brand p-2 text-white shadow">
    </div>
</form>
@endsection