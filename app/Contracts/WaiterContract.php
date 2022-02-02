<?php
namespace App\Contracts;

interface WaiterContract extends CommonContract{    
    function toggleStatus($id);
}

