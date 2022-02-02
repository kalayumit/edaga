<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentItem extends Model{
    protected $table = "payment_items";
    
    public $incrementing = false;
    protected $keyType = 'string';

    // protected $fillable = [];

    // public $timestamps = false; 

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}