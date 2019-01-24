@extends('layouts.app')

@section('content')
    <div class="mb-4"><h2>Alle Camps</h2>

<!-- Start: Dashboard -->
<table class="row display compact" id="myTable">
    <thead>
        <tr>
            <td>City</td>
            <td>Shortcode</td>
            <td>Status</td>
            <td>From</td>
            <td>To</td>
            <td>Total</td>
            <td>Free</td>
            <td>Potential</td>
            <td>Registered</td>
            <td>Confirmed</td>
            <td>Mädels-#</td>
            <td>Mädels-%</td>
            <td>Laptops</td>
            <td>Contribution</td>
            <td>Laptop Contribution</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($camps->sortBy('from') as $camp)
            <tr>
                <td class="p-2 border border-black border-2">{{ $camp->city }}</td>
                <td class="p-2 border border-black border-2"><a href="/admin/{{ $camp->id }}">{{ $camp->shortcode }}</a></td>
                <td class="p-2 border border-black border-2">{{ $camp->camp_status }}</td>
                <td class="p-2 border border-black border-2">{{ $camp->from->format('Y.m.d') }}</td>
                <td class="p-2 border border-black border-2">{{ $camp->to->format('Y.m.d') }}</td>
                <td class="p-2 border border-black border-2">{{ $camp->max }}</td>
                <td class="p-2 border border-black border-2">{{ $camp->freeSpots }}</td>
                <td class="p-2 border border-black border-2">{{ $camp->total_participants }}</td>
                <td class="p-2 border border-black border-2">{{ $camp->RegisteredParticipants }}</td>
                <td class="p-2 border border-black border-2">{{ $camp->ConfirmedParticipants }}</td>
                <td class="p-2 border border-black border-2">{{ $camp->female_participants }}</td>
                <td class="p-2 border border-black border-2">{{ $camp->female_ratio }}%</td>
                <td class="p-2 border border-black border-2">{{ $camp->orderedlaptops }}</td>
                <td class="p-2 border border-black border-2">{{ $camp->contribution }}€</td>
                <td class="p-2 border border-black border-2">{{ $camp->laptop }}€</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- Start: Latest --}}
<h3 class="mt-4">Letzte Anmeldungen</h3>

<div>
    @foreach ($last as $l)
        <div class="flex lg:w-1/2 mt-2 bg-white p-2">
            <div class="flex-1 ">{{ $l->user->firstname }}</div>
            <div class="flex-1">{{ $l->user->lastname }}</div>
            <div class="flex-1">{{ $l->camp->shortcode }}</div>
            <div class="flex-1 italic">{{ $l->created_at->diffForHumans() }}</div>
        </div>
    @endforeach
</div>
{{-- End: Latest --}}
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
@endsection
