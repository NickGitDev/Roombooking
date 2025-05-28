@extends('layouts.admin')

@section('content')
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h2><i class="bi bi-calendar-event me-2"></i> Réservations</h2>
        <a href="{{ route('reservations.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nouvelle réservation
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-dark">{{ session('success') }}</div>
    @endif
    <form method="GET" action="{{ route('reservations.index') }}" class="mb-4 row g-3">
        <div class="col-md-3">
            <label class="form-label">Salle</label>
            <select name="room_id" class="text-white form-select bg-dark">
                <option value="">Toutes</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" @selected(request('room_id') == $room->id)>
                        {{ $room->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Utilisateur</label>
            <select name="user_id" class="text-white form-select bg-dark">
                <option value="">Tous</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" @selected(request('user_id') == $user->id)>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" value="{{ request('date') }}" class="text-white form-control bg-dark">
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button class="btn btn-primary me-2"><i class="bi bi-search"></i> Filtrer</button>
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Réinitialiser</a>
        </div>
    </form>

    @if($reservations->isEmpty())
        <p>Aucune réservation pour le moment.</p>
    @else
        <div class="table-responsive">
            <table class="table table-dark table-striped">
                <thead class="table-light text-dark">
                    <tr>
                        <th>Salle</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Réservé par</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $res)
                        <tr>
                            <td>{{ $res->room->name }}</td>
                            <td>{{ $res->date }}</td>
                            <td>{{ $res->start_time }} → {{ $res->end_time }}</td>
                            <td>{{ $res->user->name }}</td>
                            <td>
                                <a href="{{ route('reservations.edit', $res) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('reservations.destroy', $res) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Supprimer cette réservation ?')" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
