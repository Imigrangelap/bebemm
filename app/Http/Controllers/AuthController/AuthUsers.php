<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthUsers extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'ip_addreas' => 'required|string|unique:users',
            'nim' => 'required|min:11',
            'jurusan' => 'required|string',
            'foto' => 'required|file|image|max:5120',
            'email' => 'required|email|unique:users',
            'no_tlp' => 'required|string|unique:users|min:12|max:15',
            'password' => 'required|min:8'
        ]);
        try {
            if ($data) {
                $fotoPath = $request->file('foto')->store('foto', 'public');
                $user = User::create([
                    'nama' => $data['nama'],
                    'ip_addreas' => $data['ip_addreas'],
                    'nim' => $data['nim'],
                    'jurusan' => $data['jurusan'],
                    'no_tlp' => $data['no_tlp'],
                    'foto' => $fotoPath,
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);

                return response()->json([
                    'message' => 'User registered',
                    'user' => $user->only(['ip_addreas', 'nama'])
                ], 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'gagal register mas!,cek log',
            ], 500);
        }
    }
}
