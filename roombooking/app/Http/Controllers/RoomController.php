<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\RoomApiService;


class RoomController extends Controller
{
    public function __construct(private RoomApiService $roomApiService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            $rooms = $this->roomApiService->all();
            dd($rooms);


            return view('admin.rooms.index', compact('rooms'));

        }
        catch (\Exception $e)
        {
            abort(500, $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'nullable|integer',
        ]);

        //Room::create($request->all());
        $this->roomApiService->create($validated);

        return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'nullable|integer|min:1',
        ]);

        $room->update($request->all());

        return redirect()->route('admin.rooms.index')->with('success', 'Salle mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Salle supprimée.');
    }
}
