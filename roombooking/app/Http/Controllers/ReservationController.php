<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Room;
use \App\Models\User;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $reservations = \App\Models\Reservation::with(['room', 'user'])
        ->when($request->filled('room_id'), fn($q) => $q->where('room_id', $request->room_id))
        ->when($request->filled('user_id'), fn($q) => $q->where('user_id', $request->user_id))
        ->when($request->filled('date'), fn($q) => $q->where('date', $request->date))
        ->orderBy('date', 'desc')
        ->get();

        $rooms = Room::all();
        $users = User::all();

        if (Auth::user() && Auth::user()->role === 'admin') {
            return view('reservations.index', compact('reservations', 'rooms', 'users'));
        }

        return view('users.index', compact('reservations'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::all();
        return view('reservations.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $exists = Reservation::where('room_id', $request->room_id)
            ->where('date', $request->date)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('start_time', '<', $request->start_time)
                            ->where('end_time', '>', $request->end_time);
                      });
            })->exists();

        if ($exists) {
            return back()->withErrors(['conflit' => 'La salle est déjà réservée à cet horaire.'])->withInput();
        }

        Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Réservation créée avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $rooms = \App\Models\Room::all();
        return view('reservations.edit', compact('reservation', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Exclure la réservation actuelle de la détection de conflit
        $exists = Reservation::where('room_id', $request->room_id)
            ->where('date', $request->date)
            ->where('id', '!=', $reservation->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('start_time', '<', $request->start_time)
                            ->where('end_time', '>', $request->end_time);
                      });
            })->exists();

        if ($exists) {
            return back()->withErrors(['conflit' => 'Conflit avec une autre réservation'])->withInput();
        }

        $reservation->update([
            'room_id' => $request->room_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Réservation mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée.');
    }
}
