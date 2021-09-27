<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;
    protected $table = 'thongtincanhan';

    protected $primaryKey = 'tt_id';

    protected $fillable = [
        'tt_diachi',
        'tt_sdt',
        'tt_gioitinh',
        'tt_ngaysinh',
        'us_id',
    ];
}
