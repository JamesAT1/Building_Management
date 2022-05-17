<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class list_of_imgs extends Model
{
    use HasFactory;
    protected $primaryKey = 'img_repair_id';
    protected $fillable = [
        'img_repair_id',
        'list_repair_id',
        'img_name',
        'img_description',
    ];
}
