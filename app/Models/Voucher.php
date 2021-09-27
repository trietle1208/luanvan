<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'magiamgia';

    protected $primaryKey = 'mgg_id';

    protected $fillable = [
        'mgg_ten',
        'mgg_macode',
        'mgg_dieukien',
        'mgg_mota',
        'mgg_hinhthuc',
        'mgg_sotiengiam',
        'mgg_soluong',
        'ncc_id',

    ];
}
