<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class check_process extends Model
{
    use HasFactory;

    protected $primaryKey = 'log_id';
    protected $fillable = [
        'log_id',
        'log_user',
        'log_prosessing',
        'log_agent'
    ];

}
