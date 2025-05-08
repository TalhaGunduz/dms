<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffAttendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = StaffAttendance::with('staff')->latest()->get();
        return view('admin.staff.attendance.index', compact('attendances'));
    }

    public function create()
    {
        $staff = Staff::where('status', 'active')->get();
        return view('admin.staff.attendance.create', compact('staff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'date' => 'required|date',
            'check_in' => 'required|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i|after:check_in',
            'status' => 'required|in:present,absent,late,on_leave',
            'notes' => 'nullable|string',
        ]);

        StaffAttendance::create($validated);

        return redirect()
            ->route('admin.staff.attendance.index')
            ->with('success', 'Personel devam kaydı başarıyla oluşturuldu.');
    }

    public function edit($id)
    {
        $attendance = StaffAttendance::findOrFail($id);
        $staff = Staff::where('status', 'active')->get();
        return view('admin.staff.attendance.edit', compact('attendance', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $attendance = StaffAttendance::findOrFail($id);
        
        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'date' => 'required|date',
            'check_in' => 'required|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i|after:check_in',
            'status' => 'required|in:present,absent,late,on_leave',
            'notes' => 'nullable|string',
        ]);

        $attendance->update($validated);

        return redirect()
            ->route('admin.staff.attendance.index')
            ->with('success', 'Personel devam kaydı başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $attendance = StaffAttendance::findOrFail($id);
        $attendance->delete();

        return redirect()
            ->route('admin.staff.attendance.index')
            ->with('success', 'Personel devam kaydı başarıyla silindi.');
    }
}
