<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = ['table_location_id','table_no','status','order_no'];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function table_location()
    {
        return $this->belongsTo(TableLocation::class);
    }
}

