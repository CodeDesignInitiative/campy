@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2>Alle Camps</h2>
    @if ($user->complete == '0')
        <div class="rounded-lg bg-yellow p-3 mb-4 mt-2">
            Profil fertigstellen: Bevor du dich für ein Camp anmelden kannst, musst du
            <a href="{{ route('profile') }}">hier</a> dein Profil vervollständigen.
        </div>
    @endif
    <p class="text-sm">Alle Camps anzeigen, aktuell auch noch jene, für die ich schon angemeldet bin.</p>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Stadt</th>
                <th scope="col">Von</th>
                <th scope="col">Bis</th>
                <th scope="col">Status</th>
                <th scope="col">Optionen</th>
            <tr>
        </thead>
        <tbody>
            @foreach ($camps as $camp)
                <tr>
                    <td class="font-bold"><a href="{{route('camp', [$camp])}}">{{ $camp->city }}</a></td>
                    <td>{{ $camp->from->format('d.m.') }}</td>
                    <td>{{ $camp->to->format('d.m.Y') }}</td>
                    <td>
                        <p class="flex items-center">
                            <span class="mr-2 inline-block rounded-full w-3 h-3 {{$camp->status == 'Warteliste' ? 'bg-orange-light' : 'bg-green text-white'}}">&zwnj;</span>
                            {{ $camp->status }}
                        </p>
                    </td>
                    <td>
                        @if ($user->complete == '1')
                            <a href="{{route('camp', [$camp])}}">Anmelden</a>
                        @else
                            <a href="{{ route('profile') }}">Profil vervollständigen</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
