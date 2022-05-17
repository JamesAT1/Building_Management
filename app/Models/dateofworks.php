<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dateofworks extends Model
{
    use HasFactory;
    protected $primaryKey = 'datework_id';
    public $timestamps = false;
    protected $fillable = [
        'datework_id',
        'user_id',
        'date_start_work',
        'date_off_work',
        'datework_check'
    ];
}
