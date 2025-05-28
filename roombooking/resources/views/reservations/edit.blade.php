@extends('layouts.admin')

@section('content')
    <h2 class="mb-4"><i class="bi bi-pencil-square me-2"></i>Modifier la réservation</h2>

    @if($errors->any())
        <div class="text-white alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservations.update', $reservation) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Salle</label>
            <select name="room_id" class="text-white form-select bg-dark">
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" @selected($reservation->room_id == $room->id)>
                        {{ $room->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date" value="{{ $reservation->date }}" class="text-white form-control bg-dark">
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Début</label>
                <input type="time" name="start_time" value="{{ $reservation->start_time }}" class="text-white form-control bg-dark">
            </div>
            <div class="mb-3 col-md-6">
                <label>Fin</label>
                <input type="time" name="end_time" value="{{ $reservation->end_time }}" class="text-white form-control bg-dark">
            </div>
        </div>

        <button class="btn btn-primary"><i class="bi bi-save me-1"></i> Mettre à jour</button>
        <a href="{{ route('reservations.index') }}" class="btn btn-secondary ms-2">Annuler</a>
    </form>
@endsection
