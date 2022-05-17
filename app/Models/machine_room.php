<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class machine_room extends Model
{
    use HasFactory;

    protected $primaryKey = 'machine_room_id';
    protected $fillable = [
        'machine_room_id',
        'machine_room_name',
        'machine_room_number',
        'machine_room_level',
        'machine_room_detail',
    ];

    public function machine_rooms_check_days(){
        return $this->hasMany(machine_rooms_check_days::class, 'machine_room_id');
    }

    // public function machine_rooms(){
    //     return $this->belongsTo(machine_rooms::class);
    // }
}
