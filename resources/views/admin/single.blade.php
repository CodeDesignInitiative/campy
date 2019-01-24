@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2>Camp: {{ $camp->shortcode }}</h2>

    <div class="text-xl mt-8 mb-2">
        {{ $camp->city }} <span class="text-md text-grey-dark">(<code>#{{ $camp->id }}</code>)</span>
    </div>
    
    <table id="myTable" class="overflow-x-auto w-full stripe">
        <thead>
            <tr class="bg-grey-light">
                <th scope="col" class="p-2">ID</th>
                <th scope="col" class="p-2">Firstname</th>
                <th scope="col" class="p-2">Lastname</th>
                <th scope="col" class="p-2">Email</th>
                <th scope="col" class="p-2">Alter</th>
                <th scope="col" class="p-2">Ernährung</th>
                <th scope="col" class="p-2">Status</th>
                <th scope="col" class="p-2">Laptop</th>
                <th scope="col" class="p-2">Beitrag</th>
                <th scope="col" class="p-2">Anmeldung</th>
                <th scope="col" class="p-2">Eltern-Email</th>
                <th scope="col" class="p-2">Kommentar</th>
                <th scope="col" class="p-2">💰</th>
                <th scope="col" class="p-2">L💰</th>
                <th scope="col" class="p-2">❌</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($camp->users->sortBy('firstname') as $user)
                <tr class="bg-white">
                    <td class="p-2">{{ $user->id }}</td>
                    <td class="p-2">{{ $user->firstname }}</td>
                    <td class="p-2">{{ $user->lastname }}</td>
                    <td class="p-2"><a href="mailto:{{ $user->email }}?subject=Code+Design%20{{ $camp->city }}&body=Hallo%20{{ $user->firstname }}">{{ $user->email }}</a></td>
                    <td class="p-2">{{ $user->age }}</td>
                    <td class="p-2">{{ $user->diet }}</td>
                    <td class="p-2">{{ $user->pivot->status }}</td>
                    <td class="p-2">{{ $user->pivot->laptop }}</td>
                    <td class="p-2">{{ $user->pivot->contribution }}</td>
                    <td class="p-2 italic">{{ $user->pivot->created_at->diffForHumans() }}</td>
                    <td class="p-2 italic">@if ($user->age < 18) {{ $user->guardian_email }} @endif</td>
                    <td class="p-2">@if ($user->pivot->comment) {{ $user->pivot->comment }} @endif</td>
                    <td class="p-2">@if ($user->pivot->status == 'registered')<a class="text-sm no-underline" href="/admin/campuser/confirm/{{ $camp->id }}/{{ $user->id }}">☑️</a>@endif</td>
                    <td class="p-2">@if ($user->pivot->laptop == 'payer')<a class="text-sm no-underline" href="/admin/campuser/confirm_laptop/{{ $camp->id }}/{{ $user->id }}">☑️</a>@endif</td>
                    <td class="p-2">@unless ($user->pivot->status == 'cancelled')<a class="text-sm no-underline" href="/admin/campuser/cancel/{{ $camp->id }}/{{ $user->id }}">❌</a>@endunless</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    (document).ready(function () {
        $('#myTable').DataTable();
    });
</script>

@endsection
