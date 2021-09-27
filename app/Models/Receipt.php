<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected $table = 'phieunhaphang';

    protected $primaryKey = 'pnh_id';

    protected $fillable = [
        'pnh_ten',
        'pnh_tongcong',
        'pnh_trangthai',
        'pnh_ngayduyet',
        'ncc_id',
        'nguoilapphieu_id',
        'nguoiduyet_id',
    ];

    public function userNhap() {
        return $this->belongsTo(User::class,'nguoilapphieu_id','id');
    }

    public function userDuyet() {
        return $this->belongsTo(User::class,'nguoiduyet_id','id');
    }

    public function ncc() {
        return $this->belongsTo(Manufacture::class,'ncc_id','ncc_id');
    }
    public function product() {
        return $this->belongsToMany(Product::class,'chitietphieunhap','pnh_id','sp_id');
    }
}
