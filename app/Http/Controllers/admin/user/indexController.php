<?php
namespace App\Http\Controllers\Admin\User;

use Alert;
use Illuminate\Support\Facades\Hash;
use Laravolt\Avatar\Facade as Avatar;  // Burada Avatar Facade'ını doğru şekilde kullandığınızdan emin olun
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    protected $model = "user";
    protected $model_text = "Kullanıcı";

    public function __construct()
    {
        // yetkilendirmeler buraya gelecek
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
        $button_link = route('admin.' . $this->model . '.index');
        return view('admin.' . $this->model . '.create', [
            'model' => $this->model,
            'model_text' => $this->model_text,
            'button_link' => $button_link,
        ]);
    }

    public function store(UserRequest $request)
    {
        $all = $request->except('_token');

        $avatar = null;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/avatars', $filename);
            $avatar = $filename;
        }

        $create = User::create([
            'name' => $all['name'],
            'email' => $all['email'],
            'password' => Hash::make($all['password']),
            'avatar' => $avatar,
        ]);
        toast($this->model . " , başarıyla eklendi", 'success');
        if (isset($create)) {
            return redirect()->route('admin.' . $this->model . '.index');
        }
    }

    public function destroy(Request $request, $id)
    {
        $delete = User::where('id', $id)->delete();
        if (isset($delete)) {
            toast($this->model . " , başarıyla silindi", 'info');
            return redirect()->route('admin.' . $this->model . '.index');
        }
    }

    public function edit(Request $request, $id)
    {
        $button_link = route('admin.' . $this->model . '.index');
        $data = User::findOrFail($id);
        return view('admin.' . $this->model . '.edit', [
            'data' => $data,
            'model' => $this->model,
            'model_text' => $this->model_text,
            'button_link' => $button_link,
        ]);
    }

    public function update(UserRequest $request, $id)
    {
        $all = $request->except('_token');
        $user = User::findOrFail($id);

        if ($request->hasFile('avatar')) {
            // Eski avatarı sil
            if ($user->avatar && Storage::exists('public/avatars/' . $user->avatar)) {
                Storage::delete('public/avatars/' . $user->avatar);
            }
            $file = $request->file('avatar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/avatars', $filename);
            $user->avatar = $filename;
        }

        $user->name = $all['name'];
        $user->email = $all['email'];
        $user->status = $all['status'] ?? 'active';
        if (!empty($all['password'])) {
            $user->password = Hash::make($all['password']);
        }
        $user->save();

        toast($this->model . " , Başarıyla düzenlendi", 'info');
        return redirect()->route('admin.' . $this->model . '.index');
    }

    public function getUsers()
    {
        $users = User::all(); // Eğer User modeliniz bu işlemi yapacaksa
        return view('user.index', compact('users'));
    }

    public function updateUserStatus(Request $request)
    {
        $userId = $request->input('user_id');
        $status = $request->input('status');

        $user = User::find($userId);
        if ($user) {
            $user->is_active = ($status == 'Aktif') ? 1 : 0;
            $user->save();
        }

        return redirect()->back(); // Kullanıcıyı yönlendirme örneği
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Check the user's status before allowing login
            $user = Auth::user();

            if ($user->status == 1) {
                // The user is active, proceed with login
                return redirect()->intended(route('home'));
            } else {
                // The user is not active, log them out
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => ['Your account is not active.'],
                ])->redirectTo(route('login'));
            }
        }

        throw ValidationException::withMessages([
            'email' => ['Invalid login credentials'],
        ])->redirectTo(route('login'));
    }

    public function data(Request $request)
    {
        $data = User::query(); // Verileri alırken query() kullanmak daha iyi bir yöntem
    
        // DataTables için server-side işleme kullanarak
        return DataTables::eloquent($data)
            ->editColumn('img', function ($item) {
                return "<img class='h-35px' src='" . Avatar::create($item->name)->toBase64() . "' />";
            })
            ->editColumn('name', function ($item) {
                return $item->name;
            })
            ->editColumn('email', function ($item) {
                return $item->email;
            })
            ->editColumn('status', function ($item) {
                return $item->status == 'active'
                    ? "<span class='badge badge-success'>Aktif</span>"
                    : "<span class='badge badge-danger'>Pasif</span>";
            })
            ->editColumn('action', function ($item) {
                return view('admin.' . $this->model . '.component.table-button', ['item' => $item, 'model' => $this->model]);
            })
            ->rawColumns(['img', 'name', 'email', 'status', 'action']) // 'action' da raw columns'a dahil edilmeli
            ->make(true); // server-side işlemi tamamlıyor
    }
}
