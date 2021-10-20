<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parameter extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'thongso';

    protected $primaryKey = 'ts_id';

    protected $fillable = [
        'ts_tenthongso',
        'loaisp_id',
    ];

    public function typeproduct()
    {
        return $this->belongsTo('App\Models\TypeProduct','loaisp_id','loaisp_id');
    }

    public function para() {
        return $this->belongsToMany(Product::class,'chitietthongso','ts_id','sp_id');
    }

    public function detail($idProduct) {
        return $this->hasMany(DetailPara::class,'ts_id','ts_id')->where('sp_id',$idProduct);
    }

    public function detail_para() {
        return $this->hasMany(DetailPara::class,'ts_id','ts_id');
    }
}
