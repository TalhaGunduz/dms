<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Room;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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

        try {
            DB::beginTransaction();

            // Oda kapasitesini kontrol et
            $room = Room::lockForUpdate()->findOrFail($request->room_id);
            
            // Oda kapasitesini kontrol et
            $currentStudentsCount = DB::table('student_room')
                ->where('room_id', $room->id)
                ->count();

            if ($currentStudentsCount >= $room->capacity) {
                throw new \Exception('Seçilen oda dolu. Lütfen başka bir oda seçiniz.');
            }

            // Şifreyi hashle
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            $data['status'] = 'active';

            // Öğrenciyi kaydet
            $student = Student::create($data);

            // Öğrenci-oda ilişkisini oluştur
            DB::table('student_room')->insert([
                'student_id' => $student->id,
                'room_id' => $room->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Oda kapasitesini güncelle
            $room->current_students = $currentStudentsCount + 1;
            $room->save();

            DB::commit();

            return redirect()->route('admin.student.index')
                ->with('success', 'Öğrenci başarıyla kaydedildi.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function getRoomsByBlock($blockId)
    {
        $rooms = Room::where('block_id', $blockId)
            ->select('id', 'number', 'capacity', 'current_students')
            ->get();

        return response()->json($rooms);
    }
} 