<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'khuyenmai';

    protected $primaryKey = 'km_id';

    protected $fillable = [
        'km_ten',
        'km_mota',
        'km_hinhanh',
        'km_hinhthuc',
        'km_giamgia',
        'km_trangthai',
        'ncc_id',
    ];

    public function product() {
        return $this->hasMany(Product::class,'km_id','km_id');
    }
}
