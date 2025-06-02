<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use App\Models\StaffRole;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        $roles = StaffRole::latest()->get();
        return view('admin.staff.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.staff.roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:staff_roles',
            'description' => 'nullable|string',
            'permissions' => 'nullable|array',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        StaffRole::create($validated);

        return redirect()
            ->route('admin.staff.roles.index')
            ->with('success', 'Rol başarıyla oluşturuldu.');
    }

    public function edit(StaffRole $role)
    {
        return view('admin.staff.roles.edit', compact('role'));
    }

    public function update(Request $request, StaffRole $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:staff_roles,name,' . $role->id,
            'description' => 'nullable|string',
            'permissions' => 'nullable|array',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $role->update($validated);

        return redirect()
            ->route('admin.staff.roles.index')
            ->with('success', 'Rol başarıyla güncellendi.');
    }

    public function destroy(StaffRole $role)
    {
        try {
            if ($role->staff()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bu role sahip personel bulunduğu için silinemez.'
                ]);
            }

            $role->forceDelete();

            return response()->json([
                'success' => true,
                'message' => 'Rol başarıyla silindi.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Rol silinirken bir hata oluştu: ' . $e->getMessage()
            ]);
        }
    }
}
