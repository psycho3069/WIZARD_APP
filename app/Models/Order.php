<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','order_number','order_date','total_price','status'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order_items(){
        return $this->hasMany(OrderItem::class);
    }
}
