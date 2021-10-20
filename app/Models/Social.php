<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    protected $table = 'mangxahoi';

    protected $primaryKey = 'mxh_id';

    protected $fillable = [
        'provider_kh_id',
        'provider',
        'kh_id',
    ];

    public function login_gg(){
        return $this->belongsTo(Customer::class,'kh_id','kh_id');
    }
}
