<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $role = $user->role;

            if ($role) {
                switch ($role->name) {
                    case 'admin':
                        return redirect()->route('dashboard.admin');
                    case 'dosen':
                        return redirect()->route('dashboard.dosen');
                    case 'editor':
                        return redirect()->route('editor.home');
                    case 'user':
                        return redirect()->route('user.home');
                    case 'author':
                        return redirect()->route('author.home');
                    case 'guest':
                        return redirect()->route('guest.home');
                    case 'customer':
                        return redirect()->route('customer.home');
                    case 'vendor':
                        return redirect()->route('vendor.home');
                    case 'manager':
                        return redirect()->route('manager.home');
                    case 'employee':
                        return redirect()->route('employee.home');
                    case 'customer-service':
                        return redirect()->route('customer-service.home');
                    case 'finance':
                        return redirect()->route('finance.home');
                    default:
                        return redirect()->route('login')->withErrors(['role' => 'Role tidak valid.']);
                }
            } else {
                return redirect()->route('login')->withErrors(['role' => 'Role tidak ditemukan.']);
            }
        }

        // Jika belum login, tampilkan halaman welcome atau login
        return view('welcome');
    }


    public function action(Request $request)
    {
        // Validasi input dari form login

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        // Coba autentikasi user berdasarkan email dan password
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->has('remember-me'))) {
            // Regenerasi session untuk menghindari session fixation
            $request->session()->regenerate();

            // Ambil data user yang sedang login
            $user = Auth::user();

            // Gunakan relasi user -> role untuk mengambil role dari user yang login
            $role = $user->role;
            // Jika relasi sudah terdefinisi di model User
            echo $role;


            if ($role) {
                // Redirect sesuai role user
                switch ($role->name) {
                    case 'Admin':
                        return redirect()->route('dashboard.admin');
                    case 'Dosen':
                        return redirect()->route('dashboard.dosen');
                    case 'editor':
                        return redirect()->route('editor.home');
                    case 'user':
                        return redirect()->route('user.home');
                    case 'author':
                        return redirect()->route('author.home');
                    case 'guest':
                        return redirect()->route('guest.home');
                    case 'customer':
                        return redirect()->route('customer.home');
                    case 'vendor':
                        return redirect()->route('vendor.home');
                    case 'manager':
                        return redirect()->route('manager.home');
                    case 'employee':
                        return redirect()->route('employee.home');
                    case 'customer-service':
                        return redirect()->route('customer-service.home');
                    case 'finance':
                        return redirect()->route('finance.home');
                    default:
                        return redirect()->route('login.page')->withErrors(['role' => 'Role tidak valid.']);
                }
            } else {
                // Jika role tidak ditemukan, redirect dengan pesan error
                return redirect()->route('login.page')->withErrors(['role' => 'Role tidak valid.']);
            }
        } else {
            // Jika login gagal, kembalikan ke halaman login dengan pesan error
            return redirect()->route('login.page')->withErrors(['login' => 'Email atau password salah.']);
        }
    }


    // ...
    public function users() {
        return view('pages.admin.users.index');
    }
    
    public function getUsers(Request $request) {
        if ($request->ajax()) {
            $data = User::with('role')->select('users.*');
            return DataTables::of($data)
                ->addColumn('role', function ($row) {
                    return $row->role ? $row->role->name : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.route('users.edit', $row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm deleteUser">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    
    //make method createF
    public function create(){
        $roles = Role::all();
        return view('pages.admin.users.create', compact('roles'));
    }
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:17',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:100000', // Validasi foto opsional
        ]);
    
        // Cek apakah ada file foto yang diunggah
        if ($request->hasFile('photo')) {
            // Simpan foto ke dalam folder storage/app/public/photos
            $photoPath = $request->file('photo')->store('profile_photos', 'public');
        } else {
            $photoPath = null; // Jika tidak ada foto yang diunggah
        }
    
        // Simpan data user ke database
        User::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'photo' => $photoPath, // Ini bisa null jika tidak ada foto
        ]);
    
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }
    
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all(); // Ambil semua role untuk dropdown
        return view('pages.admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:17',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000', // Foto opsional
        ]);

        // Update foto jika ada file baru
        if ($request->hasFile('photo')) {
            // Hapus foto lama
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            // Simpan foto baru
            $photoPath = $request->file('photo')->store('profile_photos', 'public');
        } else {
            $photoPath = $user->photo; // Gunakan foto yang lama
        }

        // Update data user di database
        $user->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'photo' => $photoPath,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        // Hapus foto dari storage
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        return response()->json(['success' => 'User deleted successfully']);
    }
    public function logout(Request $request)
{
Auth::logout();

$request->session()->invalidate();
$request->session()->regenerateToken();

return view('pages.welcome')->with('success', 'You have been logged out successfully.');
}

}
