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
        'soluonggoc'
    ];
    public function product() {
        return $this->belongsTo(Product::class,'sp_id','sp_id');
    }

    public function productdetail() {
        return $this->hasMany(Product::class,'sp_id','sp_id');
    }
}
