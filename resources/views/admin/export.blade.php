
<table>
    <thead>
        <tr>
            <th scope="col">Nummer</th>
            <th scope="col">Vorname</th>
            <th scope="col">Nachname</th>
            <th scope="col">Alter</th>
            <th scope="col">Ernährung</th>
            <th scope="col">Status</th>
            <th scope="col">Laptop</th>
            <th scope="col">Beitrag</th>
            <th scope="col">Kommentar</th>
            <th scope="col">Admin-Kommentar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($camp->users->sortBy('firstname') as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($user->pivot->status === 'cancelled')
                        <span style="text-decoration: line-through;">{{ $user->firstname }}</span>
                    @else
                        {{ $user->firstname }}
                    @endif
                </td>
                <td>
                    @if($user->pivot->status === 'cancelled')
                    <span style="text-decoration: line-through;">{{ $user->lastname }}</span>
                    @else
                        {{ $user->lastname }}
                    @endif
                </td>
                <td>{{ $user->age }}</td>
                <td>{{ $user->diet }}</td>
                <td>
                    @unless ($user->pivot->status == 'confirmed')
                        {{ $user->pivot->status }}
                    @endunless
                </td>
                <td>
                    @if ($user->pivot->laptop <> 'own')
                        x
                    @endif
                </td>
                <td>
                    @unless ($user->pivot->status == 'confirmed')
                        {{ $user->pivot->contribution }}
                    @endunless
                </td>
                <td>
                    @if ($user->pivot->comment)
                        {{ $user->pivot->comment }}
                    @endif
                </td>
                <td>
                    @if ($user->pivot->admin_comment)
                        {{ $user->pivot->admin_comment }}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>