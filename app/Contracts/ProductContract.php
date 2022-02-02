<?php
namespace App\Contracts;

interface ProductContract extends CommonContract{    
    function toggleStatus($id);
}

