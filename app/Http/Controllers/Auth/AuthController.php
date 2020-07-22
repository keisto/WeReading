<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\{RegisterFormRequest, LoginFormRequest};

class AuthController extends Controller
{
    protected $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->auth = $auth;
    }

    public function login(LoginFormRequest $request)
    {
        if (!$token = $this->auth->attempt($request->only('email', 'password'))) {
            return response()->json([
                'errors' => [
                    'root' => 'Uh oh, I couldn\'t log you in with those credentials.'
                ]
            ], 422);
        }

        return response()->json([
            'data' => $request->user(),
            'meta' => [
                'token' => $token
            ]
        ], 200);
    }

    public function register(RegisterFormRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if (!$token = $this->auth->attempt($request->only('email', 'password'))) {
            return abort(401);
        }

        return response()->json([
            'data' => $user,
            'meta' => [
                'token' => $token
            ]
        ], 200);
    }

    public function logout()
    {
        $this->auth->invalidate($this->auth->getToken());

        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    public function me(Request $request)
    {
        return response()->json(['data' => $request->user()], 200);
    }
}
