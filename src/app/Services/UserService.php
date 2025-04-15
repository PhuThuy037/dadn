<?php

namespace App\Services;


use App\Models\User;
use http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserService
{
    public function __construct(
        private readonly User $user,
    ){}

    public function register(array $data){
        try {
            $role = (isset($data['role']) && $data['role'] === 'admin') ? 'admin' : 'user';
            $user = $this->user->create([
                'name' => $data['name'],
                'email' =>$data['email'],
                'password' => Hash::make($data['password']),
                'role' => $role,
            ]);
            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user,
            ], 200);

        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }
    public function login(array $data){

        $credentials = ['email' => $data['email'], 'password' => $data['password']];

        try{
            if (! auth()->attempt($credentials)) {
                return response()->json(['error' => 'Invalid Credentials'], 403);
            }

            $user = $this->user->where('email', $data['email'])->first();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'login' => 'Login successfully',
                'user' => $user,
                'token' => $token,

            ], 200);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }
    public function logout(){
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Đăng xuất thành công'
        ], 200);
    }
    public function updateUser(array $data,$id)
    {
        try {

            $user = $this->user->find($id);

            if (! $user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            if (isset($data['name'])) {
                $user->name = $data['name'];
            }

            if (isset($data['email'])) {
                $user->email = $data['email'];
            }

            if (isset($data['role'])) {
                $user->role = $data['role'];
            }

            if (isset($data['password']) && $data['password'] !== '') {
                $user->password = Hash::make($data['password']);
            }

            $user->save();

            return response()->json([
                'message' => 'User updated successfully',
                'user' => $user
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getAllUsers(){
        try {
            $user = $this->user::where('role','user')->get();
            return response()->json([
                'user' => $user
            ]);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }
    public function getUsersWithoutRoom()
    {
        try {
            $users = User::where('role', 'user')
                ->whereDoesntHave('rooms')
                ->get();

            return response()->json([
                'users' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
