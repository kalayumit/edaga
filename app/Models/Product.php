<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{
    protected $table = "products";
    
    public $incrementing = false;
    protected $keyType = 'string';

    // protected $fillable = [];

    // public $timestamps = false;
}
