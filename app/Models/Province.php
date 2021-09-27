<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'quanhuyen';

    protected $primaryKey = 'qh_id';

    protected $fillable = [
        'qh_ten',
        'qh_loai',
        'tp_id',
    ];

    public function city() {
        return $this->belongsTo(City::class,'tp_id','tp_id');
    }
}
