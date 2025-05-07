<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomAsset;
use App\Models\Room;
use App\Models\Asset;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoomAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $roomAssets = RoomAsset::with(['room', 'asset']);
            return DataTables::of($roomAssets)
                ->addColumn('action', function ($roomAsset) {
                    return view('admin.room-assets.component.table-button', compact('roomAsset'));
                })
                ->make(true);
        }
        return view('admin.room-assets.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::all();
        $assets = Asset::where('status', 'available')->get();
        return view('admin.room-assets.create', compact('rooms', 'assets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'asset_id' => 'required|exists:assets,id',
            'assigned_date' => 'required|date',
            'return_date' => 'nullable|date|after:assigned_date',
            'status' => 'required|string|in:assigned,returned',
            'notes' => 'nullable|string'
        ]);

        $roomAsset = RoomAsset::create($validated);

        // Update asset status
        $asset = Asset::find($validated['asset_id']);
        $asset->update(['status' => 'in_use']);

        return redirect()->route('admin.room-assets.index')
            ->with('success', 'Oda demirbaş ataması başarıyla eklendi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomAsset $roomAsset)
    {
        $rooms = Room::all();
        $assets = Asset::where('status', 'available')
            ->orWhere('id', $roomAsset->asset_id)
            ->get();
        return view('admin.room-assets.edit', compact('roomAsset', 'rooms', 'assets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomAsset $roomAsset)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'asset_id' => 'required|exists:assets,id',
            'assigned_date' => 'required|date',
            'return_date' => 'nullable|date|after:assigned_date',
            'status' => 'required|string|in:assigned,returned',
            'notes' => 'nullable|string'
        ]);

        $roomAsset->update($validated);

        // Update asset status
        $asset = Asset::find($validated['asset_id']);
        $asset->update(['status' => $validated['status'] === 'returned' ? 'available' : 'in_use']);

        return redirect()->route('admin.room-assets.index')
            ->with('success', 'Oda demirbaş ataması başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomAsset $roomAsset)
    {
        // Update asset status back to available
        $asset = Asset::find($roomAsset->asset_id);
        $asset->update(['status' => 'available']);

        $roomAsset->delete();
        return redirect()->route('admin.room-assets.index')
            ->with('success', 'Oda demirbaş ataması başarıyla silindi.');
    }
}
