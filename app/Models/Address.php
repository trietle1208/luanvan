<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'diachi';

    protected $primaryKey = 'dc_id';

    protected $fillable = [
        'dc_sonha',
        'dc_tennguoinhan',
        'dc_sdt',
        'kh_id',
        'xp_id',
    ];

    public function order() {
        // dump($this->hasMany(Order::class,'dc_id','dc_id')->orderBy('dh_thoigiandathang','DESC')->get()->toArray());
        return $this->hasMany(Order::class,'dc_id','dc_id')->orderBy('dh_thoigiandathang','DESC');
    }

    public function customer() {
        return $this->belongsTo(Customer::class, 'kh_id', 'kh_id');
    }

    public function ward(){
        return $this->hasOne(Ward::class, 'xp_id', 'xp_id');
    }
}
