<?php
namespace App\Contracts;

interface CustomerContract extends CommonContract{    
    function toggleStatus($id);
    function filter($req);
}

