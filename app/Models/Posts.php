<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $table = 'baiviet';

    protected $primaryKey = 'bv_id';

    protected $fillable = [
        'dmbv_id',
        'bv_ten',
        'bv_tomtat',
        'bv_noidung',
        'bv_hinhanh',
        'bv_slug',
    ];

    public function cateposts(){
        return $this->belongsTo(CatePosts::class,'dmbv_id','dmbv_id');
    }
}
