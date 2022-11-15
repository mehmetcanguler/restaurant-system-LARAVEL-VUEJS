<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['table_id','payment_type','total'];

    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
