<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RegisterServiceInterface;

class UserController extends Controller
{
    public function register(Request $request, RegisterServiceInterface $register_service) {
        $register_service->register(
            $request->input('email'),
            $request->input('password')
        );
        return response('OK', 200);
    }
}
