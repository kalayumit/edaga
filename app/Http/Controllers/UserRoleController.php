<?php
namespace App\Http\Controllers;

use App\Services\UserRoleService;

class UserRoleController extends Controller{

    function create($userId, $roleId){

        $userRoleService = new UserRoleService();
        return $userRoleService->addRole($userId, $roleId);
    }

    function delete($userId, $roleId){
        $userRoleService = new UserRoleService();
        return $userRoleService->deleteRole($userId, $roleId);
    }

}
