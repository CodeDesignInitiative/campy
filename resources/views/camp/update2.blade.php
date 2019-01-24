@extends('layouts.app')

@section('content')

<div>User ID: {{ $camp->pivot->user_id }}</div>
<div>User: {{ $user->firstname }} </div>
<div>Contribution: {{ $camp->pivot->contribution }}</div>
<div>Laptop: {{ $camp->pivot->laptop }}</div>
<div class="p-2">Status: 

@switch($camp->pivot->status)
    @case('registered')
        <span class="bg-yellow p-1 rounded text-xs">Registriert</span>
        @break

    @case('confirmed')
        <span class="bg-green-light p-1 rounded text-xs">Bestätigt</span>
        @break

    @case('cancelled')
        <span class="bg-red p-1 rounded text-xs text-white">Abgesagt</span>
        @break

    @case('waiting')
        <span class="bg-orange-light p-1 rounded text-xs">Warteliste</span>
        @break

    @default
        Unbekannt
@endswitch

</div>
<div>Comment: <textarea name="comment" id="" cols="30" rows="10">{{ $camp->pivot->comment }}</textarea></div>
<div>Reason: {{ $camp->pivot->reason_for_cancellation }}</div>


@if ($camp->pivot->laptop == 'payer' and $camp->pivot->status != 'waiting')
<div class="mt-4 border-red border-t-2 bg-white p-4"><div class="bg-red-lightest -mt-4 -ml-4 -mr-4 p-2 font-bold">Um deine Laptopleihe zu bestätigen, überweise bitte genau (!) wie folgt:</div>
<ul class="leading-normal">    
    <li><em>Betrag</em>: 50€</li>
<li><em>Empfänger</em>: Code+Design Initiative e.V.</li> 
<li><em>Bank</em>: Sparkasse Berlin</li>
<li><em>IBAN</em>: DE24100500000190607629</li>
<li><em>BIC</em>: BELADEBEXXX</li> 
<li><em>Verwendungszweck</em>: Unkosten Laptop Leihe {{ $user->firstname }} {{ $user->lastname }} {{ $camp->shortcode }}</li>
</ul>

<p class="mt-4"><strong>Hinweis: </strong> Die Überweisung muss bis {{ $camp->from->subWeeks(2)->format('d.m.Y') }}</p>

</div>
@endif

@endsection

@section('scripts')

</script>
@endsection