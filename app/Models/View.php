<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;
    protected $table = 'luotxem';

    protected $primaryKey = 'id_view';

    protected $fillable = [
        'sp_id',
        'view',
        'session'
    ];
}
