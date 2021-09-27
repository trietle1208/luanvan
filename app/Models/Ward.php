<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $table = 'xaphuong';

    protected $primaryKey = 'xp_id';

    protected $fillable = [
        'xp_ten',
        'xp_loai',
        'qh_id',
    ];

    public function province() {
        return $this->belongsTo(Province::class,'qh_id','qh_id');
    }
}
