<?php
namespace App\Contracts;

interface RoleContract{

    function create($request);
    function update($request, $id);
    function enable($id);
    function disable($id);

}
