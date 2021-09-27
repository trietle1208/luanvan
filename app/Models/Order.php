<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'donhang';

    protected $primaryKey = 'dh_id';

    protected $fillable = [
        'dh_madonhang',
        'dh_tongtien',
        'dh_trangthai',
        'dh_ghichu',
        'dh_thoigiandathang',
        'dh_thoigiangiaohang',
        'dh_thoigiannhanhang',
        'ht_id',
        'dc_id',
        'gh_id',
    ];

    public function orderNCC()
    {
        return $this->hasMany(OrderNCC::class, 'dh_id', 'dh_id');
    }

    public function address() {
        return $this->belongsTo(Address::class, 'dc_id', 'dc_id');
    }


}
