<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $table = 'hinhthucthanhtoan';

    protected $primaryKey = 'ht_id';

    protected $fillable = [
        'ht_ten',
        'ht_hinhanh',
    ];
}
