<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function index()
    {
        $students = Student::with(['rooms' => function($query) {
            $query->with('block');
        }])->get();
        
        $rooms = Room::with('block')->get();
        
        return view('admin.transfer.index', compact('students', 'rooms'));
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'new_room_id' => 'required|exists:rooms,id'
        ]);

        try {
            DB::beginTransaction();

            $student = Student::findOrFail($request->student_id);
            $newRoom = Room::findOrFail($request->new_room_id);

            // Yeni odanın kapasitesini kontrol et
            if ($newRoom->isFull()) {
                return back()->with('error', 'Seçilen oda dolu!');
            }

            // Öğrencinin mevcut odasından çıkar
            $student->rooms()->detach();

            // Yeni odaya ekle
            $student->rooms()->attach($request->new_room_id);

            DB::commit();
            return back()->with('success', 'Öğrenci başarıyla transfer edildi.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Transfer işlemi sırasında bir hata oluştu.');
        }
    }
}
