<?php

namespace App\Services;

use App\Contracts\AuthServiceContract;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\ForgotPassword;
use Exception;
use Illuminate\Support\Str;

class AuthService implements AuthServiceContract
{

    protected $_model = "App\\Models\\User";

    //logs a user in
    function login($request)
    {


        $credentials = $request->only(['email', 'password']);
        try{
            if (!$token = Auth::attempt($credentials)) {
                return response()->json('Incorrect credentials', 401);
            }
            return response()->json(['access_token' => $token], 200);
        }catch(Exception $e){
            return response($e, 500);
        }



    }

    //TO-DO
    //refreshs token up on being sent
    function refreshToken($token)
    {
    }

    function logout()
    {
        Auth::invalidate();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    // function sendForgotRequestCode($email){

    //     $obj = $this->_model::where('email', $email)->first();
    //     if(!$obj){
    //         return response()->json('There is no account with that email address', $email);
    //     }
    //     $reset_code = Str::random(6);
    //     $forgot_password = new ForgotPassword();
    //     $forgot_password->email = $email;
    //     $forgot_password->reset_code = $reset_code;
    //     try{
    //         $forgot_password->save();
    //         //send email to user
    //         $this->sendEmail($email, $reset_code);
    //         return response()->json('Request sent', 200);
    //     }catch(Exception $e){
    //         return response()->json('Something went wrong', 500);
    //     }
    // }


    protected function sendEmail($email, $resetcode){
        mail($email, 'Retail Service',
        'Here is your reset/activation code for Retail service ' . $resetcode , null, null);
    }

    // function confirmEmail($email)
    // {
    //     $user = ForgotPassword::where('email', $email->email);
    //     if ($user == '') {
    //         return response()->json('User not found', 404);
    //     }
    //     if ($user->reset_code === $email->reset_code) {
    //         //activate user here
    //         $user = User::find($user->id);
    //         $user->status = true;
    //         $user->save();
    //         return response()->json('Email confirmed', 200);
    //     } else {
    //         return response()->json('User not found', 404);
    //     }
    // }
}
