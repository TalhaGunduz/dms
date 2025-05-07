<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceRequest;
use App\Models\Room;
use App\Models\Asset;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MaintenanceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $maintenanceRequests = MaintenanceRequest::with(['room', 'asset', 'requester']);
            return DataTables::of($maintenanceRequests)
                ->addColumn('action', function ($maintenanceRequest) {
                    return view('admin.maintenance-requests.component.table-button', compact('maintenanceRequest'));
                })
                ->make(true);
        }
        return view('admin.maintenance-requests.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::all();
        $assets = Asset::where('status', 'in_use')->get();
        return view('admin.maintenance-requests.create', compact('rooms', 'assets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'asset_id' => 'required|exists:assets,id',
            'requester_id' => 'required|exists:users,id',
            'priority' => 'required|string|in:low,medium,high',
            'status' => 'required|string|in:pending,in_progress,completed,cancelled',
            'requested_date' => 'required|date',
            'scheduled_date' => 'nullable|date|after:requested_date',
            'description' => 'required|string'
        ]);

        $maintenanceRequest = MaintenanceRequest::create($validated);

        // Update asset status
        $asset = Asset::find($validated['asset_id']);
        $asset->update(['status' => 'maintenance']);

        return redirect()->route('admin.maintenance-requests.index')
            ->with('success', 'Bakım talebi başarıyla oluşturuldu.');
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
    public function edit(MaintenanceRequest $maintenanceRequest)
    {
        $rooms = Room::all();
        $assets = Asset::where('status', 'in_use')
            ->orWhere('id', $maintenanceRequest->asset_id)
            ->get();
        return view('admin.maintenance-requests.edit', compact('maintenanceRequest', 'rooms', 'assets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MaintenanceRequest $maintenanceRequest)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'asset_id' => 'required|exists:assets,id',
            'requester_id' => 'required|exists:users,id',
            'priority' => 'required|string|in:low,medium,high',
            'status' => 'required|string|in:pending,in_progress,completed,cancelled',
            'requested_date' => 'required|date',
            'scheduled_date' => 'nullable|date|after:requested_date',
            'description' => 'required|string'
        ]);

        $maintenanceRequest->update($validated);

        // Update asset status based on maintenance request status
        $asset = Asset::find($validated['asset_id']);
        $asset->update([
            'status' => $validated['status'] === 'completed' ? 'in_use' : 'maintenance'
        ]);

        return redirect()->route('admin.maintenance-requests.index')
            ->with('success', 'Bakım talebi başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaintenanceRequest $maintenanceRequest)
    {
        // Update asset status back to in_use
        $asset = Asset::find($maintenanceRequest->asset_id);
        $asset->update(['status' => 'in_use']);

        $maintenanceRequest->delete();
        return redirect()->route('admin.maintenance-requests.index')
            ->with('success', 'Bakım talebi başarıyla silindi.');
    }
}
