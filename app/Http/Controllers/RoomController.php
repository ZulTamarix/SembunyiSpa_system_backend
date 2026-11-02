<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController
{
    // 1) GET — fetch all
    public function index()
    {
        return response()->json(Room::all());
    }

    // 2) POST
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string',
            'description'  => 'required|string',
        ]);

        // Check if data already exists, if not create it
        Room::firstOrCreate(
            [
                'name' => $validated['name'],
                'description' => $validated['description'],
            ]
        );
    }

    // 3) PUT
    public function update(Request $request, string $id)
    {
        // find id
        $room = Room::findOrFail($id);

        // Validate request
        $validated = $request->validate([
            'name'  => 'required|string',
            'description'  => 'required|string',
        ]);

        // Update
        $room->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);
    }
    
    // 4) DELETE
    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
    }
}
