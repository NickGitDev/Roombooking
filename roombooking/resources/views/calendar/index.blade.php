@extends('layouts.admin')

@section('content')
    <h2 class="mb-4"><i class="bi bi-calendar2-week"></i> Calendrier des réservations</h2>

    <div id="calendar"></div>
    <!-- Modal de création -->
<div class="modal fade" id="reservationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="reservationForm" method="POST" action="{{ route('reservations.store') }}" class="text-white modal-content bg-dark">
          @csrf
          <div class="modal-header">
              <h5 class="modal-title">Nouvelle réservation</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
              <label>Salle</label>
              <select name="room_id" class="mb-3 text-white form-select bg-dark" required>
                  @foreach(\App\Models\Room::all() as $room)
                      <option value="{{ $room->id }}">{{ $room->name }}</option>
                  @endforeach
              </select>

              <label>Date</label>
              <input type="date" name="date" id="res-date" class="mb-3 text-white form-control bg-dark" required>

              <label>Heure de début</label>
              <input type="time" name="start_time" class="mb-3 text-white form-control bg-dark" required>

              <label>Heure de fin</label>
              <input type="time" name="end_time" class="mb-3 text-white form-control bg-dark" required>
          </div>
          <div class="modal-footer">
              <button class="btn btn-success" type="submit">Réserver</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          </div>
      </form>
    </div>
  </div>
@endsection



@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/main.min.css" rel="stylesheet">
    <style>
        #calendar {
            background: white;
            padding: 20px;
            border-radius: 1rem;
            color: black;
        }
    </style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'fr',
                timeZone: 'local',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                selectable: true,
                events: '{{ route('calendar.events') }}',
                dateClick: function(info) {
                    document.getElementById('res-date').value = info.dateStr;
                    new bootstrap.Modal(document.getElementById('reservationModal')).show();
                },
                eventDidMount: function(info) {
                    if (info.event.extendedProps.user) {
                        info.el.setAttribute('title', 'Réservé par : ' + info.event.extendedProps.user); // <- essentiel
                        new bootstrap.Tooltip(info.el);
                    }
                }


            });

            calendar.render();
        });
    </script>

@endpush
