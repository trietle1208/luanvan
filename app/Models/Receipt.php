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
}
