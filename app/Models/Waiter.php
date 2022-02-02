<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Waiter extends Model{
    protected $table = "waiters";
    
    public $incrementing = false;
    protected $keyType = 'string';

    // protected $fillable = [];

    // public $timestamps = false;
}