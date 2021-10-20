<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $table = 'yeuthich';

    protected $primaryKey = 'id_yt';

    protected $fillable = [
        'kh_id',
        'sp_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class,'sp_id','sp_id');
    }
}
