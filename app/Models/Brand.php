<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'thuonghieu';

    protected $primaryKey = 'th_id';

    protected $fillable = [
        'th_ten',
        'th_mota',
        'th_slug',
        'th_hinhanh',
    ];

    public function product()
    {
        return $this->hasMany('App\Models\Product','th_id');
    }
}
