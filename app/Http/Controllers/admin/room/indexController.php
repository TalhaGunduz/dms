<?php

namespace App\Http\Controllers\Admin\Room;

use Alert;
use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Room;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\RoomRequest; // RoomRequest'i kullanalım
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class IndexController extends Controller
{
    protected $model = "room";
    protected $model_text = "Oda";

    public function __construct()
    {
        // Burada yetkilendirme ve diğer middleware'ler eklenebilir
    }

    public function index()
    {
        $blocks = Block::with('rooms')->get();
        return view('admin.room.index', [
            'blocks' => $blocks,
            'model' => $this->model,
            'model_text' => $this->model_text
        ]);
    }

    public function create()
    {
        $blocks = Block::all();
        return view('admin.room.create', [
            'blocks' => $blocks,
            'model' => $this->model,
            'model_text' => $this->model_text
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'block_id' => 'required|exists:blocks,id',
            'number' => 'required|string',
            'capacity' => 'required|integer|min:1|max:5'
        ]);

        Room::create($request->all());

        return redirect()->route('admin.room.index')
            ->with('success', 'Oda başarıyla oluşturuldu.');
    }

    public function destroy(Request $request, $id)
    {
        $delete = Room::where('id', $id)->delete();
        if ($delete) {
            toast($this->model_text . " başarıyla silindi", 'info');
            return redirect()->route('admin.' . $this->model . '.index');
        }
    }

    public function edit(Request $request, $id)
    {
        $button_link = route('admin.' . $this->model . '.index');
        $data = Room::findOrFail($id);
        return view('admin.' . $this->model . '.edit', [
            'data' => $data,
            'model' => $this->model,
            'model_text' => $this->model_text,
            'button_link' => $button_link,
        ]);
    }

    public function update(RoomRequest $request, $id)
    {
        // Doğrulama başarılı olduğunda, veriler geçerli olduğundan emin olabiliriz
        $validated = $request->validated();

        // Oda bilgilerini güncelle
        $update = Room::where('id', $id)->update([
            'number' => $validated['number'],
            'capacity' => $validated['capacity'],
            'block' => $validated['block'] ?? null, // Blok null olabilir
        ]);

        toast($this->model_text . " başarıyla güncellendi", 'info');
        if ($update) {
            return redirect()->route('admin.' . $this->model . '.index');
        }
    }

    public function getRoomsByBlock($blockId)
    {
        $rooms = Room::where('block_id', $blockId)
            ->select('id', 'number', 'capacity', 'current_students')
            ->get();

        return response()->json($rooms);
    }

    public function data(Request $request)
    {
        $data = Room::query(); // Odalar için sorgu oluştur

        // DataTables için server-side işleme
        return DataTables::eloquent($data)
            ->editColumn('number', function ($item) {
                return $item->number; // Oda numarası
            })
            ->editColumn('capacity', function ($item) {
                return $item->capacity;
            })
            ->editColumn('current_students', function ($item) {
                return $item->current_students . ' / ' . $item->capacity; // Mevcut öğrenci sayısı
            })
            ->editColumn('block', function ($item) {
                return $item->block ? $item->block->name . ' Blok ' . $item->block->information : 'Bilinmiyor';
            })
            
            ->editColumn('action', function ($item) {
                return view('admin.' . $this->model . '.component.table-button', ['item' => $item, 'model' => $this->model]);
            })
            ->rawColumns(['number', 'capacity', 'current_students', 'block', 'action'])
            ->make(true); // server-side işlemi tamamlıyor
    }

    public function show($id)
    {
        $room = Room::with(['students', 'block'])->findOrFail($id);
        return view('admin.room.show', [
            'room' => $room,
            'model' => $this->model,
            'model_text' => $this->model_text
        ]);
    }
}
