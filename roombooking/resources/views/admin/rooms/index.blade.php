@extends('layouts.admin')

@section('content')
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h2><i class="bi bi-door-closed-fill me-2"></i>Liste des salles</h2>
        <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Ajouter une salle
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-dark">{{ session('success') }}</div>
    @endif

    @if($rooms->isEmpty())
        <p>Aucune salle enregistrée.</p>
    @else
        <div class="table-responsive">
            <table class="table align-middle table-dark table-striped">
                <thead class="table-light text-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Capacité</th>
                        <th>Description</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                        <tr>
                            <td>{{ $room->name }}</td>
                            <td>{{ $room->capacity ?? '-' }}</td>
                            <td>{{ $room->description ?? '-' }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette salle ?')">
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
