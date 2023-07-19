<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kasir extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_kasir',
        'item_id',
        'user_id',
        'jumlah',
        'sub',
        'status'
    ];
}
