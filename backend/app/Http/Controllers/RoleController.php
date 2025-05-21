<?php

namespace App\Http\Controllers;

use App\Http\Middleware\JwtAuthMiddleware; // Import middleware
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
   
    public function index()
    {
        Log::info('RoleController index method accessed.');

        $roles = Role::all();
        Log::info('Roles fetched: ', $roles->toArray());

        return response()->json($roles);
    }
     public function store(Request $request)
{
   
    // Validasi dan logika untuk menyimpan role
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:roles,name',
        'is_active' => 'required|boolean',
        'description' => 'nullable|array',
    ]);
 
    // Membuat role baru
    $role = Role::create([
        'name' => $validated['name'],
        'is_active' => $validated['is_active'],
        'description' => $validated['description'] ?? null,
    ]);

    // Mengembalikan respons sukses
    return response()->json([
        'message' => 'Role created successfully!',
        'data' => $role,
    ], 201);
}
public function destroy($id)
    {
        // return response()->json(["ok"]);
        // Cari role berdasarkan ID
        $role = Role::find($id);

        // Kalau role tidak ditemukan
        if (!$role) {
            return response()->json([
                'message' => 'Role not found'
            ], 404);
        }

        // Hapus role
        $role->delete();

        return response()->json([
            'message' => 'Role deleted successfully'
        ], 200);
    }
   

public function update(Request $request, $id)
{
    
    $role = Role::find($id);
// return response()->json(["ok"]);
   
    if (!$role) {
        return response()->json([
            'message' => 'Role not found'
        ], 404);
    }

   
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|array',
        'is_active' => 'required|boolean',
    ]);

    
    $role->name = $validated['name'];
    $role->description = $validated['description'];
    $role->is_active = $validated['is_active'];
    $role->save();

    return response()->json([
        'message' => 'Role updated successfully',
        'data' => $role
    ], 200);
}

}