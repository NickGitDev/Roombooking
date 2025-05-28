@extends('layouts.admin')

@section('content')
    <h2 class="mb-4"><i class="bi bi-plus-circle me-2"></i>Créer une réservation</h2>

    @if($errors->any())
        <div class="text-white alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Salle</label>
            <select name="room_id" class="text-white form-select bg-dark" required>
                <option value="">Choisir une salle</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" @selected(old('room_id') == $room->id)>
                        {{ $room->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="text-white form-control bg-dark" value="{{ old('date') }}" required>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label">Heure de début</label>
                <input type="time" name="start_time" class="text-white form-control bg-dark" value="{{ old('start_time') }}" required>
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label">Heure de fin</label>
                <input type="time" name="end_time" class="text-white form-control bg-dark" value="{{ old('end_time') }}" required>
            </div>
        </div>

        <button class="btn btn-success" type="submit">
            <i class="bi bi-check-circle me-1"></i> Réserver
        </button>
        <a href="{{ route('reservations.index') }}" class="btn btn-secondary ms-2">Annuler</a>
    </form>
@endsection
