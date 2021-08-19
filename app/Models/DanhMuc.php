<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhMuc extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'danhmuc';

    protected $primaryKey = 'dm_id';

    protected $fillable = [
        'dm_ten',
        'dm_mota',
        'dm_slug',
        'dm_idcha',
        'deleted_at',
    ];

    public function product()
    {
        return $this->hasMany('App\Models\Product','dm_id');
    }
}
