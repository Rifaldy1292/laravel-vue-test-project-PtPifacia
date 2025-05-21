<?php



namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
            'employee_id' => 'required|uuid', // Validasi UUID untuk employee_id
            'role_id' => 'required|uuid', // Validasi UUID untuk role_id
            'description' => 'required|array', // Validasi bahwa description adalah array
            'description.nickname' => 'required|string|max:255', // Validasi nickname dalam description
            'description.department' => 'required|string|max:255', // Validasi department dalam description
        ]);

        // Membuat user baru dengan data yang diterima dari request
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'employee_id' => $request->employee_id,
            'role_id' => $request->role_id,
            'description' => json_encode($request->description), // Menyimpan description sebagai JSON
        ]);

        // Membuat token JWT untuk user yang baru saja didaftarkan
        $token = JWTAuth::fromUser($user);

        // Mengirimkan response dengan data user dan token
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Email atau password salah'], 401);
        }

        return response()->json([
            'token' => $token,
            'user' => auth()->user()
        ]);
    }
}
