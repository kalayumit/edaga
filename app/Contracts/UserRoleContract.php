<?php
namespace App\Contracts;

interface UserRoleContract {
    function addRole($request, $id);
    function deleteRole($id);
}
