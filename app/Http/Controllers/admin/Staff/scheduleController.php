<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffSchedule;
use Illuminate\Http\Request;

class scheduleController extends Controller
{
    public function index()
    {
        $schedules = StaffSchedule::with('staff')->latest()->get();
        return view('admin.staff.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $staff = Staff::where('status', 'active')->get();
        return view('admin.staff.schedules.create', compact('staff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'day_of_week' => 'required|in:weekdays,monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'break_start' => 'nullable|date_format:H:i',
            'break_end' => 'nullable|date_format:H:i|after:break_start',
            'status' => 'required|in:active,inactive',
            'notes' => 'nullable|string',
        ]);

        // Format time values
        $validated['start_time'] = date('H:i:s', strtotime($validated['start_time']));
        $validated['end_time'] = date('H:i:s', strtotime($validated['end_time']));
        
        if (!empty($validated['break_start'])) {
            $validated['break_start'] = date('H:i:s', strtotime($validated['break_start']));
        }
        
        if (!empty($validated['break_end'])) {
            $validated['break_end'] = date('H:i:s', strtotime($validated['break_end']));
        }

        // If weekdays is selected, create schedules for all weekdays
        if ($validated['day_of_week'] === 'weekdays') {
            $weekdays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
            foreach ($weekdays as $day) {
                $scheduleData = $validated;
                $scheduleData['day_of_week'] = $day;
                StaffSchedule::create($scheduleData);
            }
        } else {
            StaffSchedule::create($validated);
        }

        return redirect()
            ->route('admin.staff.schedules.index')
            ->with('success', 'Personel çalışma programı başarıyla oluşturuldu.');
    }

    public function edit($id)
    {
        $schedule = StaffSchedule::findOrFail($id);
        $staff = Staff::where('status', 'active')->get();
        return view('admin.staff.schedules.edit', compact('schedule', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $schedule = StaffSchedule::findOrFail($id);
        
        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'day_of_week' => 'required|in:weekdays,monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'break_start' => 'nullable|date_format:H:i',
            'break_end' => 'nullable|date_format:H:i|after:break_start',
            'status' => 'required|in:active,inactive',
            'notes' => 'nullable|string',
        ]);

        // Format time values
        $validated['start_time'] = date('H:i:s', strtotime($validated['start_time']));
        $validated['end_time'] = date('H:i:s', strtotime($validated['end_time']));
        
        if (!empty($validated['break_start'])) {
            $validated['break_start'] = date('H:i:s', strtotime($validated['break_start']));
        }
        
        if (!empty($validated['break_end'])) {
            $validated['break_end'] = date('H:i:s', strtotime($validated['break_end']));
        }

        $schedule->update($validated);

        return redirect()
            ->route('admin.staff.schedules.index')
            ->with('success', 'Personel çalışma programı başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $schedule = StaffSchedule::findOrFail($id);
        $schedule->delete();

        return redirect()
            ->route('admin.staff.schedules.index')
            ->with('success', 'Personel çalışma programı başarıyla silindi.');
    }

    public function data()
    {
        $schedules = StaffSchedule::with('staff')->get();
        return response()->json(['data' => $schedules]);
    }
}
