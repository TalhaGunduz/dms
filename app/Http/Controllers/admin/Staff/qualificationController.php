<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffQualification;
use Illuminate\Http\Request;

class qualificationController extends Controller
{
    public function index()
    {
        $qualifications = StaffQualification::with('staff')->latest()->get();
        return view('admin.staff.qualifications.index', compact('qualifications'));
    }

    public function create()
    {
        $staff = Staff::where('status', 'active')->get();
        return view('admin.staff.qualifications.create', compact('staff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'notes' => 'nullable|string',
        ]);

        StaffQualification::create($validated);

        return redirect()
            ->route('admin.staff.qualifications.index')
            ->with('success', 'Personel niteliği başarıyla oluşturuldu.');
    }

    public function edit($id)
    {
        $qualification = StaffQualification::findOrFail($id);
        $staff = Staff::where('status', 'active')->get();
        return view('admin.staff.qualifications.edit', compact('qualification', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $qualification = StaffQualification::findOrFail($id);

        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'notes' => 'nullable|string',
        ]);

        $qualification->update($validated);

        return redirect()
            ->route('admin.staff.qualifications.index')
            ->with('success', 'Personel niteliği başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $qualification = StaffQualification::findOrFail($id);
        $qualification->delete();

        return redirect()
            ->route('admin.staff.qualifications.index')
            ->with('success', 'Personel niteliği başarıyla silindi.');
    }
}
