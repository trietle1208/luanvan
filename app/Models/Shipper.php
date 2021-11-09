<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{
    use HasFactory;
    protected $table = 'shipper';

    protected $primaryKey = 'gh_id';

    protected $fillable = [
        'gh_hovaten',
        'gh_email',
        'gh_matkhau',
        'gh_sdt',
        'gh_ngaysinh',
        'gh_gioitinh',
        'ncc_id',
    ];

    public function info()
    {
        return $this->belongsTo(Info::class,'us_id','gh_id');
    }
}
