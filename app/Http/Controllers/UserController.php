<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Untuk query ke database
use App\Models\User; // Model User untuk mengambil data user
use App\Models\Role; // Model Role untuk mengambil data role

class UserController extends Controller
{
    public function index() {
        // Jika user sudah login, redirect ke home setelah login
        if (Auth::check()) {
            return redirect()->route('home-after-login');
        }
        return view('welcome');
    }

    public function action(Request $request) {
        // Validasi input dari form login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba autentikasi user berdasarkan email dan password
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->has('remember-me'))) {
            // Jika login berhasil, ambil data user yang sedang login
            $user = Auth::user();
            
            // Ambil role dari tabel roles berdasarkan role_id di tabel users
            $role = Role::find($user->role_id);
            
            // Jika role ditemukan
            if ($role) {
                // Redirect sesuai role user
                return redirect()->route('home-after-login')->with('role', $role->name); // 'name' adalah kolom nama role di tabel roles
            } else {
                // Jika role tidak ditemukan, redirect dengan pesan error
                return redirect()->route('login')->withErrors(['role' => 'Role tidak valid.']);
            }
        } else {
            // Jika login gagal, kembalikan ke halaman login dengan pesan error
            return redirect()->route('login')->withErrors(['login' => 'Email atau password salah.']);
        }
    }
}
