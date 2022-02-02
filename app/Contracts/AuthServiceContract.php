<?php
namespace App\Contracts;

interface AuthServiceContract {
    function login($request);
    function logout();
    // function confirmEmail($request);
    function refreshToken($request);
}
