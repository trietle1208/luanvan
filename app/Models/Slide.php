<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slide extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'slide';

    protected $primaryKey = 'sl_id';

    protected $fillable = [
        'sl_ten',
        'sl_mota',
        'sl_hinhanh',
    ];
}
