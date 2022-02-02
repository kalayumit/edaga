<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller{


    function login(Request $request){
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $authService = new AuthService();
        return $authService->login($request);
    }

    function refreshToken(Request $request){
        $authService = new AuthService();
        return $authService->refreshToken($request);
    }

    function logout(){

    }


}
