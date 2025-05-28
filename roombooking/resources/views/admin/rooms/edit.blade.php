@extends('layouts.admin')

@section('content')
    <h2 class="mb-4"><i class="bi bi-pencil me-2"></i>Modifier la salle</h2>

    @if($errors->any())
        <div class="text-white alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.rooms.update', $room) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nom de la salle</label>
            <input type="text" name="name" id="name" value="{{ $room->name }}" class="text-white form-control bg-dark" required>
        </div>

        <div class="mb-3">
            <label for="capacity" class="form-label">Capacité (optionnelle)</label>
            <input type="number" name="capacity" id="capacity" value="{{ $room->capacity }}" class="text-white form-control bg-dark">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (optionnelle)</label>
            <textarea name="description" id="description" class="text-white form-control bg-dark" rows="4">{{ $room->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i> Mettre à jour
        </button>
        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary ms-2">Annuler</a>
    </form>
@endsection
