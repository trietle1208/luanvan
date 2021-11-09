<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'binhluan';

    protected $primaryKey = 'bl_id';

    protected $fillable = [
        'bl_noidung',
        'bl_sosao',
        'bl_idcha',
        'bl_hinhanh',
        'sp_id',
        'kh_id',
        'us_id',
        'trangthai',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class,'kh_id','kh_id');
    }

    public function admin(){
        return $this->belongsTo(User::class,'us_id','id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'sp_id','sp_id');
    }
}
