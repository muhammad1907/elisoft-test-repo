<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    // Soal no 5
    public function getUsers()
    {
        $users = User::all();

        if ($users) {
            $response = [
                'status' => true,
                'message' => 'Success',
                'data' => $users
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Failed',
                'data' => []
            ];
        }

        return response()->json($response);
    }

    public function getUser()
    {
        return view('layouts.users.create');
    }


    public function getUsersAll() {
        $users = User::all();
        return view('layouts.users.getall', ['users' => $users]);
    }
    public function createUser(Request $request)
    {
       // Validasi input dari request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Check if email already exists
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            Log::info('false');
            return redirect()->route('user-create')->with('errorMessage', 'User with this email already exists.');
        }

        // Buat user baru
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        Log::info('true');
        $user->sendEmailVerificationNotification();

        return redirect()->route('user-all')->with('success', 'User berhasil dibuat.');
    }

    // Fungsi untuk membaca data user
    public function readUser($id)
    {
        // Cari user berdasarkan id
        $user = User::findOrFail($id);

        return view('layouts.users.read', compact('user'));
    }

    public function editUser($id)
    {
        // Cari user berdasarkan id
        $user = User::findOrFail($id);

        return view('layouts.users.edit', compact('user'));
    }
    // Fungsi untuk mengubah data user
    public function updateUser(Request $request, $id)
    {
    
        // Cari user berdasarkan id
        $user = User::findOrFail($id);

        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user-all')->with('success', 'User berhasil diupdate.');
    }

    //delete
    public function deleteUser(Request $request, $id)
    {
        $currentUser = Auth::user();
        $userToDelete = User::findOrFail($id);

        // Cek apakah user yang ingin dihapus sama dengan user yang sedang login
        if ($currentUser->id == $userToDelete->id) {
            $errorMessage = 'Tidak bisa menghapus akun yang sedang digunakan.';
            return redirect()->route('user-all')->with('errorMessage', $errorMessage);
        }

        // Hapus user
        $userToDelete->delete();

        return redirect()->route('user-all')->with('success', 'User berhasil dihapus.');
    }

        
}
