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
    ];

    public function parameter()
    {
        return $this->hasMany('App\Models\Parameter','loaisp_id');
    }


}
