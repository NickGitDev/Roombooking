@extends('layouts.admin')

@section('content')
    <h2 class="mb-4"><i class="bi bi-plus-lg me-2"></i>Ajouter une salle</h2>

    @if($errors->any())
        <div class="text-white alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.rooms.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nom de la salle</label>
            <input type="text" name="name" id="name" class="text-white form-control bg-dark" required>
        </div>

        <div class="mb-3">
            <label for="capacity" class="form-label">Capacité (optionnelle)</label>
            <input type="number" name="capacity" id="capacity" class="text-white form-control bg-dark">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (optionnelle)</label>
            <textarea name="description" id="description" class="text-white form-control bg-dark" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-save me-1"></i> Enregistrer
        </button>
        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary ms-2">Annuler</a>
    </form>
@endsection
