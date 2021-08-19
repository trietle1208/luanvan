<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'hinhanh';

    protected $primaryKey = 'ha_id';

    protected $fillable = [
        'ha_ten',
        'ha_mota',
        'ha_duongdan',
        'sp_id',
    ];
}
