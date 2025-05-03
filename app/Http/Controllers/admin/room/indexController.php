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
        $button_link = route('admin.' . $this->model . '.create');
        return view('admin.' . $this->model . '.index', [
            'model' => $this->model,
            'model_text' => $this->model_text,
            'button_link' => $button_link,
        ]);
    }
    public function create()
    {
        // Blokları veritabanından alıyoruz
        $blocks = Block::all();
        
        // Diğer veriler ve linkler
        $button_link = route('admin.' . $this->model . '.index');
        
        // Verileri view'e gönderiyoruz
        return view('admin.' . $this->model . '.create', [
            'model' => $this->model,
            'model_text' => $this->model_text,
            'button_link' => $button_link,
            'blocks' => $blocks, // blocks değişkenini ekliyoruz
        ]);
    }
    

    public function store(RoomRequest $request)
{
    // RoomRequest, verilerin doğrulamasını yapacak
    $validated = $request->validated();

    // Oda kaydını oluştur
    $room = Room::create([
        'number' => $validated['number'],
        'capacity' => $validated['capacity'],
        'block_id' => $validated['block_id'], // Doğru key bu!
    ]);

    // Başarı mesajı
    toast($this->model_text . " başarıyla eklendi", 'success');

    // Başarılı ise index sayfasına yönlendir
    return redirect()->route('admin.' . $this->model . '.index');
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
}
