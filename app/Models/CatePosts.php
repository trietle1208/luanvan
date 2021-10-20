<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatePosts extends Model
{
    use HasFactory;
    protected $table = 'danhmucbaiviet';

    protected $primaryKey = 'dmbv_id';

    protected $fillable = [
        'dmbv_ten',
        'dmbv_mota',
        'dmbv_slug',
    ];

    public function posts() {
        return $this->hasMany(Posts::class,'dmbv_id','dmbv_id');
    }
}
