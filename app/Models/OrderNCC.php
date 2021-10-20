<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderNCC extends Model
{
    use HasFactory;
    protected $table = 'donhangncc';

    protected $primaryKey = 'dhncc_id';

    protected $fillable = [
        'dh_id',
        'ncc_id',
        'mgg_id',
        'tongtien',
        'trangthai',
        'gh_id',
        'thoigiangiaohang',
        'thoigiannhanhang',
    ];

    public function orderAdmin(){
        return $this->belongsTo(Order::class, 'dh_id', 'dh_id');
    }

    public function orderDetail(){
        return $this->hasMany(OrderDetail::class, 'dhncc_id', 'dhncc_id');
    }

    public function voucher(){
        return $this->belongsTo(Voucher::class, 'mgg_id', 'mgg_id');
    }

    public function ncc(){
        return $this->belongsTo(Manufacture::class,'ncc_id','ncc_id');
    }

    public function shipper(){
        return $this->belongsTo(User::class,'gh_id','id');
    }

}
