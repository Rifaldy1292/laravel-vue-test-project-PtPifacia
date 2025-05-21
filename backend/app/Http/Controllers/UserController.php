<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Menampilkan semua data pengguna
   public function index()
    {
        // Mengambil semua pengguna dan memuat relasi 'employee' dan 'role' secara bersamaan
        $users = User::with(['employee', 'role'])->get();

        // Mengembalikan data dengan nama employee dan role
        return response()->json($users);
    }

    // Menambahkan data pengguna baru
    public function store(Request $request)
    {
        // Validasi data yang dikirim
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),  // Mengenkripsi password
        ]);

        return response()->json($user, 201);  // Mengembalikan data pengguna baru
    }

    // Menampilkan data pengguna berdasarkan ID
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);  // Mengembalikan data pengguna
    }

    // Mengupdate data pengguna
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Validasi data yang dikirim
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Update data pengguna
        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return response()->json($user);  // Mengembalikan data pengguna yang sudah diupdate
    }

    // Menghapus data pengguna
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();  // Menghapus pengguna

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
