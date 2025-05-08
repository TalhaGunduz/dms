<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class indexController extends Controller
{
    public function index()
    {
        $staff = Staff::with(['role', 'qualification', 'document', 'schedule', 'attendance'])->get();
        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        $roles = StaffRole::where('status', 'active')->get();
        return view('admin.staff.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'salary' => 'nullable|numeric',
            'status' => 'required|in:active,inactive,on_leave',
            'role_id' => 'required|exists:staff_roles,id',
        ]);

        Staff::create($validated);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Personel başarıyla oluşturuldu.');
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        $roles = StaffRole::where('status', 'active')->get();
        return view('admin.staff.edit', compact('staff', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'salary' => 'nullable|numeric',
            'status' => 'required|in:active,inactive,on_leave',
            'role_id' => 'required|exists:staff_roles,id',
        ]);

        $staff->update($validated);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Personel başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->route('admin.staff.index')
            ->with('success', 'Personel başarıyla silindi.');
    }

    public function data()
    {
        $staff = Staff::with(['role', 'qualification', 'document', 'schedule', 'attendance'])
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'email' => $item->email,
                    'department' => $item->department,
                    'position' => $item->position,
                    'hire_date' => $item->hire_date,
                    'status' => $item->status,
                ];
            });

        return response()->json(['data' => $staff]);
    }
}
