<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Room;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function create()
    {
        $blocks = Block::all();
        return view('admin.student.create', compact('blocks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tc_no' => 'required|unique:students,tc_no',
            'name' => 'required',
            'surname' => 'required',
            'birth_date' => 'required|date',
            'school' => 'required',
            'department' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:6',
            'block_id' => 'required|exists:blocks,id',
            'room_id' => 'required|exists:rooms,id'
        ]);

        // Oda kapasitesini kontrol et
        $room = Room::findOrFail($request->room_id);
        if ($room->current_students >= $room->capacity) {
            return back()->withErrors(['room_id' => 'Seçilen oda dolu.']);
        }

        // Şifreyi hashle
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['status'] = 'active';

        // Öğrenciyi kaydet
        $student = Student::create($data);

        // Oda kapasitesini güncelle
        $room->increment('current_students');

        return redirect()->route('admin.student.index')
            ->with('success', 'Öğrenci başarıyla kaydedildi.');
    }

    public function getRoomsByBlock($blockId)
    {
        $rooms = Room::where('block_id', $blockId)
            ->select('id', 'number', 'capacity', 'current_students')
            ->get();

        return response()->json($rooms);
    }
} 