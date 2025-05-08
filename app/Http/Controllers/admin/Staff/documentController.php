<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class documentController extends Controller
{
    public function index()
    {
        $documents = StaffDocument::with('staff')->latest()->get();
        return view('admin.staff.documents.index', compact('documents'));
    }

    public function create()
    {
        $staff = Staff::where('status', 'active')->get();
        return view('admin.staff.documents.create', compact('staff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'document_type' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'notes' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('staff-documents', 'public');
            $validated['file_path'] = $path;
        }

        StaffDocument::create($validated);

        return redirect()
            ->route('admin.staff.documents.index')
            ->with('success', 'Personel belgesi başarıyla oluşturuldu.');
    }

    public function edit($id)
    {
        $document = StaffDocument::findOrFail($id);
        $staff = Staff::where('status', 'active')->get();
        return view('admin.staff.documents.edit', compact('document', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $document = StaffDocument::findOrFail($id);

        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'document_type' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'notes' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            // Eski dosyayı sil
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }
            $path = $request->file('file')->store('staff-documents', 'public');
            $validated['file_path'] = $path;
        }

        $document->update($validated);

        return redirect()
            ->route('admin.staff.documents.index')
            ->with('success', 'Personel belgesi başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $document = StaffDocument::findOrFail($id);

        if ($document->file_path) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()
            ->route('admin.staff.documents.index')
            ->with('success', 'Personel belgesi başarıyla silindi.');
    }

    public function download($id)
    {
        $document = StaffDocument::findOrFail($id);
        
        if (!$document->file_path || !Storage::disk('public')->exists($document->file_path)) {
            return redirect()
                ->route('admin.staff.documents.index')
                ->with('error', 'Dosya bulunamadı.');
        }

        return Storage::disk('public')->download(
            $document->file_path,
            $document->document_type . '_' . $document->staff->name . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION)
        );
    }
}
