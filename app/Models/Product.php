<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProductImage;
use App\Models\Parameter;
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'sanpham';

    protected $primaryKey = 'sp_id';

    protected $fillable = [
        'sp_ten',
        'sp_giabanra',
        'sp_soluong',
        'sp_mota',
        'sp_slug',
        'sp_chitiet',
        'sp_thoigianbaohanh',
        'sp_trangthai',
        'sp_hinhanh',
        'loaisp_id',
        'ncc_id',
        'th_id',
        'dm_id',
        'km_id',
    ];

    public function images() {
        return $this->hasMany(ProductImage::class,'sp_id');
    }

    public function para() {
        return $this->belongsToMany(Parameter::class,'chitietthongso','sp_id','ts_id');
    }

    public function cate() {
        return $this->belongsTo(DanhMuc::class,'dm_id','dm_id');
    }

    public function brand() {
        return $this->belongsTo(Brand::class,'th_id','th_id');
    }

    public function ncc() {
        return $this->belongsTo(Manufacture::class,'ncc_id','ncc_id');
    }

    public function detail() {
        return $this->hasMany(DetailPara::class,'sp_id','sp_id');
    }

    public function receiptdetail($id) {
        return $this->hasMany(ReceiptDetail::class,'sp_id','sp_id')->where('pnh_id',$id);
    }

    public function detailquantity() {
        return $this->hasMany(ReceiptDetail::class,'sp_id','sp_id');
    }

    public function discount() {
        return $this->belongsTo(Discount::class,'km_id','km_id')->where('km_trangthai',1);
    }

}
