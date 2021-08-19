<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPara extends Model
{
    use HasFactory;
    protected $table = 'chitietthongso';

    protected $primaryKey = 'chitiet_id';

    protected $fillable = [
        'ts_id',
        'sp_id',
        'chitietthongso',
    ];

}
