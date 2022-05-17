<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class machine_descriptions extends Model
{
    use HasFactory;

    protected $primaryKey = 'machine_description_id';
    protected $fillable = [
        'machine_description_id',
        'machine_rooms_check_day_id',
        'machine_description_name',
        'machine_description_image',
    ];

    // public function machine_rooms_check_days(){
    //     return $this->belongsTo(machine_rooms_check_days::class);
    // }
}
