@extends('layouts.user')

@section('content')
    <h2 class="mb-4"><i class="bi bi-calendar-event me-2"></i>Mes Réservations</h2>

    <a href="{{ route('reservations.create') }}" class="mb-4 btn btn-success">
        <i class="bi bi-plus-circle"></i> Réserver une salle
    </a>

    @if($reservations->isEmpty())
        <p>Aucune réservation encore.</p>
    @else
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Salle</th>
                    <th>Date</th>
                    <th>Heure</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $res)
                    <tr>
                        <td>{{ $res->room->name }}</td>
                        <td>{{ $res->date }}</td>
                        <td>{{ $res->start_time }} - {{ $res->end_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
