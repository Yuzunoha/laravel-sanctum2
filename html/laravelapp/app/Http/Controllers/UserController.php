<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginPost;
use App\Http\Requests\UserRegisterPost;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $utilService;
    protected $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    public function login(UserLoginPost $request)
    {
        return $this->userService->login(
            $request->email,
            $request->password
        );
    }

    public function register(UserRegisterPost $request)
    {
        return $this->userService->create(
            $request->name,
            $request->email,
            $request->password
        );
    }

    public function logout()
    {
        return $this->userService->logout(Auth::user());
    }

    public function selectAll()
    {
        return User::all();
    }
}
