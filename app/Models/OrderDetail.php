<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'chitietdonhang';

    protected $primaryKey = 'ctdh_id';

    protected $fillable = [
        'dhncc_id',
        'sp_id',
        'km_id',
        'gia',
        'soluong',
    ];

    public function product() {
        return $this->belongsTo(Product::class,'sp_id','sp_id');
    }

    public function discount(){
        return $this->belongsTo(Discount::class,'km_id','km_id');
    }

    public function order_ncc(){
        return $this->belongsTo(OrderNCC::class,'dhncc_id','dhncc_id');
    }
}
