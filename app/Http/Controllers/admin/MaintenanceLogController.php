<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceLog;
use App\Models\MaintenanceRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MaintenanceLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $maintenanceLogs = MaintenanceLog::with(['maintenanceRequest', 'maintenanceRequest.asset', 'maintainer']);
            return DataTables::of($maintenanceLogs)
                ->addColumn('action', function ($maintenanceLog) {
                    return view('admin.maintenance-logs.component.table-button', compact('maintenanceLog'));
                })
                ->make(true);
        }
        return view('admin.maintenance-logs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $maintenanceRequests = MaintenanceRequest::where('status', 'in_progress')->get();
        $maintainers = User::role('maintainer')->get();
        return view('admin.maintenance-logs.create', compact('maintenanceRequests', 'maintainers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'maintenance_request_id' => 'required|exists:maintenance_requests,id',
            'maintainer_id' => 'required|exists:users,id',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|string|in:completed,failed',
            'maintenance_date' => 'required|date',
            'description' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        $maintenanceLog = MaintenanceLog::create($validated);

        // Update maintenance request status
        $maintenanceRequest = MaintenanceRequest::find($validated['maintenance_request_id']);
        $maintenanceRequest->update(['status' => 'completed']);

        // Update asset status
        $asset = $maintenanceRequest->asset;
        $asset->update(['status' => 'in_use']);

        return redirect()->route('admin.maintenance-logs.index')
            ->with('success', 'Bakım kaydı başarıyla oluşturuldu.');
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
    public function edit(MaintenanceLog $maintenanceLog)
    {
        $maintenanceRequests = MaintenanceRequest::where('status', 'in_progress')
            ->orWhere('id', $maintenanceLog->maintenance_request_id)
            ->get();
        $maintainers = User::role('maintainer')->get();
        return view('admin.maintenance-logs.edit', compact('maintenanceLog', 'maintenanceRequests', 'maintainers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MaintenanceLog $maintenanceLog)
    {
        $validated = $request->validate([
            'maintenance_request_id' => 'required|exists:maintenance_requests,id',
            'maintainer_id' => 'required|exists:users,id',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|string|in:completed,failed',
            'maintenance_date' => 'required|date',
            'description' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        $maintenanceLog->update($validated);

        // Update maintenance request status
        $maintenanceRequest = MaintenanceRequest::find($validated['maintenance_request_id']);
        $maintenanceRequest->update(['status' => 'completed']);

        // Update asset status
        $asset = $maintenanceRequest->asset;
        $asset->update(['status' => 'in_use']);

        return redirect()->route('admin.maintenance-logs.index')
            ->with('success', 'Bakım kaydı başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaintenanceLog $maintenanceLog)
    {
        // Update maintenance request status back to in_progress
        $maintenanceRequest = MaintenanceRequest::find($maintenanceLog->maintenance_request_id);
        $maintenanceRequest->update(['status' => 'in_progress']);

        // Update asset status back to maintenance
        $asset = $maintenanceRequest->asset;
        $asset->update(['status' => 'maintenance']);

        $maintenanceLog->delete();
        return redirect()->route('admin.maintenance-logs.index')
            ->with('success', 'Bakım kaydı başarıyla silindi.');
    }
}
