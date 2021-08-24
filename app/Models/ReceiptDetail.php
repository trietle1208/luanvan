<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptDetail extends Model
{
    use HasFactory;
    protected $table = 'chitietphieunhap';

    protected $primaryKey = 'ctpn_id';

    protected $fillable = [
        'sp_id',
        'pnh_id',
        'soluong',
        'giagoc',
    ];
}
