<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableLocation extends Model
{
    use HasFactory;

    protected $fillable = ['title','color'];

    public function table()
    {
        return $this->hasMany(Table::class);
    }
}
