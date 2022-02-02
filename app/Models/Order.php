<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model{
    protected $table = "orders";
    
    public $incrementing = false;
    protected $keyType = 'string';

    // protected $fillable = [];

    // public $timestamps = false;    

    public function items()
    {
        return $this->hasMany('App\Models\OrderItem', 'order_id');
    }

    public function waiter()
    {
        return $this->belongsTo('App\Models\Waiter');
    }
}