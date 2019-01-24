@extends('layouts.app')

@section('content')
<div class="mb-4">
    <div class="mb-4">
        <h2>Meine Camps</h2>
        <p class="text-sm">Nur die Camps anzeigen, für die ich registriert bin.</p>
        <p class="text-sm mt-2">
            Über den Link <strong>Details</strong> kannst du bei jedem Camp den Fortschritt deiner Anmeldung sehen
            (Laptop, Bezahlung), innerhalb der Frist deine Daten ändern und absagen.
        </p>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Stadt</th>
                    <th scope="col">Von</th>
                    <th scope="col">Bis</th>
                    <th scope="col">Status</th>
                    <th scope="col">Laptop?</th>
                    <th scope="col">Optionen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($camp_user as $camp)
                    <tr>
                        <td class="font-bold"><a href="mycamps/{{ $camp->id }}/edit">{{ $camp->city }}</a></th>
                        <td>{{ $camp->from->format('d.m.') }}</td>
                        <td>{{ $camp->to->format('d.m.Y') }}</td>
                        <td>@component('components.status_camp', ['camp' => $camp->pivot->status]) @endcomponent</td>
                        <td>@component('components.status_laptop', ['laptop' => $camp->pivot->laptop]) @endcomponent</td>
                        <td><a href="{{route('camp', [$camp])}}">Details</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection