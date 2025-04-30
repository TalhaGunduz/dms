<?php

namespace App\Http\Controllers\Admin\Student;

use Alert;
use Illuminate\Support\Facades\Hash;
use Laravolt\Avatar\Facade as Avatar;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Models\Room;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;


class IndexController extends Controller
{
    protected $model = "student";
    protected $model_text = "Öğrenci";

    public function __construct()
    {
        // Burada yetkilendirme ve diğer middleware'ler eklenebilir
    }

    public function index()
    {
        $students = Student::all();
        $button_link = route('admin.' . $this->model . '.create');
        return view('admin.' . $this->model . '.index', [
            'model' => $this->model,
            'model_text' => $this->model_text,
            'button_link' => $button_link,
            
        ]);
    }

    public function create()
    {
        $rooms = Room::all();  // Tüm odaları alıyoruz
        return view('admin.student.create', compact('rooms'));
        return view('admin.' . $this->model . '.create', [
            'model' => $this->model,
            'model_text' => $this->model_text,
            'button_link' => $button_link,
            
        ]);
    }

    public function store(StudentRequest $request)
    {
        $all = $request->except('_token');

        // Öğrenci kaydını oluştur
        $create = Student::create([
            'tc_no' => $all['tc_no'],
            'name' => $all['name'],
            'surname' => $all['surname'],
            'birth_date' => $all['birth_date'],
            'school' => $all['school'],
            'department' => $all['department'],
            'phone' => $all['phone'],
            'room_id' => $all['room_id'] ?? null, // Oda ID'si opsiyonel olabilir
            'email' => $all['email'],
            'password' => Hash::make($all['password']),
        ]);

        toast($this->model_text . " başarıyla eklendi", 'success');
        if ($create) {
            return redirect()->route('admin.' . $this->model . '.index');
        }
    }

    public function destroy(Request $request, $id)
    {
        $delete = Student::where('id', $id)->delete();
        if ($delete) {
            toast($this->model_text . " başarıyla silindi", 'info');
            return redirect()->route('admin.' . $this->model . '.index');
        }
    }

    public function edit(Request $request, $id)
    {
        $button_link = route('admin.' . $this->model . '.index');
        $data = Student::findOrFail($id);
        return view('admin.' . $this->model . '.edit', [
            'data' => $data,
            'model' => $this->model,
            'model_text' => $this->model_text,
            'button_link' => $button_link,
        ]);
    }

    public function update(StudentRequest $request, $id)
    {
        $all = $request->except('_token');

        // Öğrenci bilgilerini güncelle
        $update = Student::where('id', $id)->update([
            'tc_no' => $all['tc_no'],
            'name' => $all['name'],
            'surname' => $all['surname'],
            'birth_date' => $all['birth_date'],
            'school' => $all['school'],
            'department' => $all['department'],
            'phone' => $all['phone'],
            'room_id' => $all['room_id'] ?? null,
            'email' => $all['email'],
            'status' => $all['status'],
            'password' => Hash::make($all['password']),
        ]);

        toast($this->model_text . " başarıyla güncellendi", 'info');
        if ($update) {
            return redirect()->route('admin.' . $this->model . '.index');
        }
    }

    


    public function show($id)
    {
        // Öğrenciyi ID'sine göre bul
        $student = Student::findOrFail($id); 
        $student = Student::with('room')->findOrFail($id);
    
        // Model text'i belirleyelim
        $model_text = 'Öğrenci Detayları';  // Bu değeri değiştirebilirsiniz
    
        // Öğrenciyi ve model_text'i view'e gönderelim
        return view('admin.student.show', compact('student', 'model_text'));
    }
    

    public function getData(Request $request)
    {
        // Öğrenci verilerini alıyoruz
        $students = Student::all();  // Veya, veritabanından verilerinizi çektiğiniz özel bir sorgu

        // Öğrenci verilerini JSON formatında döndürüyoruz
        return response()->json(['data' => $students]);
    }
    



    public function getStudents()
    {
        $students = Student::all(); // Öğrencileri al
        return view('admin.' . $this->model . '.index', compact('students'));
    }

    public function updateStudentStatus(Request $request)
    {
        $studentId = $request->input('student_id');
        $status = $request->input('status');

        $student = Student::find($studentId);
        if ($student) {
            $student->status = ($status == 'Aktif') ? 1 : 0;
            $student->save();
        }

        return redirect()->back();
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $student = Auth::user(); // Öğrenci bilgilerini al

            if ($student->status == 1) {
                return redirect()->intended(route('home'));
            } else {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => ['Hesabınız aktif değil.'],
                ])->redirectTo(route('login'));
            }
        }

        throw ValidationException::withMessages([
            'email' => ['Geçersiz giriş bilgileri'],
        ])->redirectTo(route('login'));
    }

    public function data(Request $request)
    {
        $data = Student::query(); // Öğrenciler için sorgu oluştur

        // DataTables için server-side işleme
        return DataTables::eloquent($data)
        ->editColumn('img', function ($item) {
            return "<img class='h-35px' src='" . Avatar::create($item->name)->toBase64() . "' />";
        })
            ->editColumn('name', function ($item) {
                return $item->name . ' ' . $item->surname; // Ad ve soyad birleştir
            })
            ->editColumn('email', function ($item) {
                return $item->email;
            })
            ->editColumn('status', function ($item) {
                return $item->status == 1
                    ? "<span class='badge badge-success'>Aktif</span>"
                    : "<span class='badge badge-danger'>Pasif</span>";
            })
            ->editColumn('action', function ($item) {
                return view('admin.' . $this->model . '.component.table-button', ['item' => $item, 'model' => $this->model]);
            })
            ->rawColumns(['img', 'name', 'email', 'status', 'action'])
            ->make(true); // server-side işlemi tamamlıyor
    }
}
