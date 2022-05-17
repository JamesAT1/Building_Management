<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class date_for_checkings extends Model
{
    use HasFactory;

    protected $primaryKey = 'date_id';
    public $timestamps = false;
    protected $fillable = [
        'date_id',
        'start_date',
        'end_date',
    ];
}
