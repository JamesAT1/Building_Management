<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class machine_rooms_check_days extends Model
{
    use HasFactory;
    protected $primaryKey = 'machine_rooms_check_day_id';
    protected $fillable = [
        'machine_rooms_check_day_id',
        'machine_room_id',
        'machine_rooms_check_day_status',
        'machine_rooms_check_day_description',
        'shift_worker_time',
        'machine_room_problem',
        'img_for_checked'
    ];

    // public function machine_descriptions(){
    //     return $this->hasMany(machine_descriptions::class);
    // }

    public function machine_room(){
        return $this->belongsTo(machine_room::class);
    }
}
