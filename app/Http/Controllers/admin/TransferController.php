<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Block;
use App\Models\Room;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function index()
    {
        $students = Student::with(['rooms.block'])->get();
        $model_text = 'Transfer';
        $button_link = '';
        return view('admin.transfer.index', compact('students', 'model_text', 'button_link'));
    }

    public function edit($studentId)
    {
        $student = Student::with(['rooms.block'])->findOrFail($studentId);
        $blocks = Block::all();
        $rooms = Room::all();
        return view('admin.transfer.edit', compact('student', 'blocks', 'rooms'));
    }

    public function update(Request $request, $studentId)
    {
        $request->validate([
            'block_id' => 'required|exists:blocks,id',
            'room_id' => 'required|exists:rooms,id',
        ]);

        $student = Student::findOrFail($studentId);
        $oldRoom = $student->rooms()->first();
        $newRoom = Room::findOrFail($request->room_id);

        DB::transaction(function () use ($student, $oldRoom, $newRoom, $request) {
            if ($oldRoom) {
                $student->rooms()->detach($oldRoom->id);
            }
            $student->rooms()->attach($newRoom->id);
            Transfer::create([
                'student_id' => $student->id,
                'from_room_id' => $oldRoom ? $oldRoom->id : null,
                'to_room_id' => $newRoom->id,
                'transfer_date' => now(),
                'reason' => $request->input('reason') ?: '',
                'status' => 'completed',
            ]);
        });

        return redirect()->route('admin.transfer.index')->with('success', 'Transfer işlemi başarıyla tamamlandı.');
    }

    public function data()
    {
        $transfers = Transfer::with(['student', 'fromRoom', 'toRoom'])
            ->orderBy('created_at', 'desc')
            ->get();

        return datatables()->of($transfers)
            ->addColumn('student_name', function ($transfer) {
                return $transfer->student->name;
            })
            ->addColumn('from_room', function ($transfer) {
                return $transfer->fromRoom->room_number;
            })
            ->addColumn('to_room', function ($transfer) {
                return $transfer->toRoom->room_number;
            })
            ->addColumn('actions', function ($transfer) {
                return view('admin.transfer.actions', compact('transfer'))->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
