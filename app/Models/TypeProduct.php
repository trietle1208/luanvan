<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeProduct extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'loaisanpham';

    protected $primaryKey = 'loaisp_id';

    protected $fillable = [
        'loaisp_ten',
        'loaisp_mota',
        'loaisp_slug',
        'dm_id',
    ];

    public function parameter()
    {
        return $this->hasMany(Parameter::class,'loaisp_id');
    }

    public function cate()
    {
        return $this->belongsTo(DanhMuc::class,'dm_id','dm_id');
    }

    public function product() {
        return $this->hasMany(Product::class,'loaisp_id');
    }

}
