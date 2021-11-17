<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'khachhang';

    protected $primaryKey = 'kh_id';

    protected $fillable = [
        'kh_hovaten',
        'kh_email',
        'kh_matkhau',
        'kh_sdt',
        'kh_ngaysinh',
        'kh_gioitinh',
        'kh_hinhanh',
    ];

    // public function receivesBroadcastNotificationsOn()
    // {
    //     return 'users.'.$this->id;
    // }

    public function address(){
        return $this->hasMany(Address::class,'kh_id','kh_id');
    }

    public function product_wishlist(){
        return $this->belongsToMany(Product::class,'yeuthich','kh_id','sp_id');
    }

}
