<?php
namespace App\Contracts;
use App\Contracts\CommonContract;

interface UserContract extends CommonContract {

    // function createUser($request);
    // function updateUser($request, $id);
    function enableUser($id);
    function disableUser($id);

}
