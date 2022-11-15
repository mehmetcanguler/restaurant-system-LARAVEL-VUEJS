<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','title','content','image','price','total'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
