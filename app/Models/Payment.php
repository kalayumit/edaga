<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model{
    protected $table = "payments";
    
    public $incrementing = false;
    protected $keyType = 'string';

    // protected $fillable = [];

    // public $timestamps = false;    

    public function items()
    {
        return $this->hasMany('App\Models\PaymentItem', 'payment_id');
    }

    public function waiter()
    {
        return $this->belongsTo('App\Models\Waiter');
    }
}