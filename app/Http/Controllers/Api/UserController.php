<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\RegisterServiceInterface;

class UserController extends Controller
{
    public function __construct(RegisterServiceInterface $register_service) {
        $this->register_service = $register_service;
    }

    /**
     * authenticate user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response('OK', 200);
        }

        return response('NG', 403);
    }

    /**
     * register user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        $this->register_service->register(
            $request->input('email'),
            $request->input('password')
        );
        return response('OK', 200);
    }

    /**
     * logout user.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout() {
        Auth::logout();
        return response('OK', 200);
    }
}
