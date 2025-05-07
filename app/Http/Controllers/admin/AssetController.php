<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $assets = Asset::query();
            
            // Debug information
            \Log::info('Assets query:', [
                'count' => $assets->count(),
                'sql' => $assets->toSql(),
                'bindings' => $assets->getBindings()
            ]);
            
            try {
                return DataTables::of($assets)
                    ->addColumn('action', function ($asset) {
                        return view('admin.assets.component.table-button', compact('asset'));
                    })
                    ->toJson();
            } catch (\Exception $e) {
                \Log::error('DataTables error:', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
        
        return view('admin.assets.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.assets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:furniture,electronics',
            'description' => 'nullable|string',
            'serial_number' => 'nullable|string|unique:assets',
            'purchase_price' => 'nullable|numeric|min:0',
            'purchase_date' => 'nullable|date',
            'status' => 'required|string|in:available,in_use,maintenance,disposed'
        ]);

        Asset::create($validated);

        return redirect()->route('admin.assets.index')
            ->with('success', 'Demirbaş başarıyla eklendi.');
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
    public function edit(Asset $asset)
    {
        return view('admin.assets.edit', compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:furniture,electronics',
            'description' => 'nullable|string',
            'serial_number' => 'nullable|string|unique:assets,serial_number,' . $asset->id,
            'purchase_price' => 'nullable|numeric|min:0',
            'purchase_date' => 'nullable|date',
            'status' => 'required|string|in:available,in_use,maintenance,disposed'
        ]);

        $asset->update($validated);

        return redirect()->route('admin.assets.index')
            ->with('success', 'Demirbaş başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        $asset->delete();
        return redirect()->route('admin.assets.index')
            ->with('success', 'Demirbaş başarıyla silindi.');
    }
}
