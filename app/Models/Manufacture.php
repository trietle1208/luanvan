<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    use HasFactory;
    protected $table = 'nhacungcap';

    protected $primaryKey = 'ncc_id';

    protected $fillable = [
        'ncc_ten',
        'ncc_diachi',
        'ncc_sdt',
        'ncc_mota',
        'ncc_hinhanh',
    ];

    public function user() {
        return $this->hasMany(User::class,'ncc_id');
    }

    public function product() {
        return $this->hasMany(Product::class,'ncc_id');
    }

    public static function getData($id)
    {
        return Manufacture::find($id);
    }
}
