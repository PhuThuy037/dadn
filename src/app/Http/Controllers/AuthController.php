<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserSignUpRequest;

use App\Http\Requests\UserUpdateInfoRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;


class AuthController extends Controller
{
   public function __construct(
       private readonly UserService $authService,
   ){}
    public function login(UserLoginRequest $request)
    {

        return $this->authService->login($request->validated());
    }
    public function register(UserSignUpRequest $request)
    {

        return $this->authService->register($request->validated());
    }
    public function logout(Request $request)
    {

        return $this->authService->login($request);
    }
    public function updateUser(UserUpdateInfoRequest $request, User $user)
    {

        return $this->authService->updateUser($request->validated(),(int) $user->id);
    }

    public function home()
    {
        return view('home');
    }
}
