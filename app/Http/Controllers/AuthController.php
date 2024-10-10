<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register (Request $request){
        //validasi inputan/request
        $validasi = Validator::make($request->all(),[
            "name" => 'required',
            "email" => 'required|email',
            "password" => 'required'
        ]);
        //cek validasi gagal
        if($validasi->fails()) {
            return response()->json(['message' => 'invalid field','error brow'=> $validasi->errors()]);
        }
        //create user baru
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password
        ]);
        //generate token untuk rergister
        $token = $user->createToken('auth_token')->plainTextToken;
        // mengembalikan data json
        return response()->json(['message' => 'anjayy akun baru' ,'data' => $user,'token' => $token]);

    }
//funsi login
    public function login(Request $request){
           //validasi inputan/request
        $validasi = Validator::make($request->all(),[
            "email" => 'required|email',
            "password" => 'required'
        ]);
        //cek validasi gagal
        if($validasi->fails()) {
            return response()->json(['message' => 'invalid field','error brow'=> $validasi->errors()]);
        }
        if (!Auth::attempt($request->only('email','password'))){
            return response()->json(['message'=>'email or password salah'], 401);
        }
        //cek user email//
        $user = User::where('email',$request->email)->firstOrFail();
//generate token untuk login
        $token = $user->createToken('auth_token')->plainTextToken;
 // mengembalikan data json
        return response()->json(['message' => 'joss kamu login' ,'data' => $user,'token' => $token]);
    }
    public function logout(Request $request) {
        // Hapus token yang digunakan untuk otentikasi
        $request->user()->currentAccessToken()->delete();

        // Mengembalikan respons json
        return response()->json(['message' => 'Logout berhasil']);
    }
}
