@php
    use Carbon\Carbon;

    $start = Carbon::parse($month)->startOfMonth();
    $end = Carbon::parse($month)->endOfMonth();
@endphp

@while ($start <= $end)
    @php
        $date = $start->format('Y-m-d');
    @endphp
    <tr>
        <td>{{ $start->format('d-m-Y') }}</td>
        <td>{{ !empty($lunchesByDate[$date]) ? 'Sí' : 'No' }}</td>
    </tr>
    @php $start->addDay(); @endphp
@endwhile
