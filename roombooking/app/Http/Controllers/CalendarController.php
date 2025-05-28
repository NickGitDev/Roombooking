<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    public function events()
    {
        $reservations = Reservation::with('room','user')->get();
        $colors = [
            'Salle A' => '#0d6efd',
            'Salle B' => '#198754',
            'Salle C' => '#dc3545',
        ];

        $events = $reservations->map(function ($res) use ($colors) {
            return [
                'title' => $res->room->name,
                'start' => $res->date . 'T' . $res->start_time,
                'end' => $res->date . 'T' . $res->end_time,
                'color' => $colors[$res->room->name] ?? '#6c757d',
                'extendedProps' => [
                'user' => $res->user->name,
    ],
            ];
        });

        return response()->json($events);
    }
}
