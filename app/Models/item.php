<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;
    protected $fillable=['nama_item', 'stok_item', 'satuan', 'harga_item', 'user_id'];
}
