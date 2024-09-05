<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Role;

class UserController extends Controller
{
    public function index() {
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
    

    public function action(Request $request) {
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
             echo($role);
             
            
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
                        return redirect()->route('login')->withErrors(['role' => 'Role tidak valid.']);
                }
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
