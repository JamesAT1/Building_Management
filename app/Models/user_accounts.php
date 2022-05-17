<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_accounts extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
        'user_name',
        'user_pass',
        'user_firstname',
        'user_lastname',
        'user_begindatetowork',
        'user_img',
        'user_contrack',
        'user_birth',
        'user_nickname',
        'user_rule_status',
        'user_sick_leave',
        'user_personal_leave',
        'user_vacation_leave',
    ];
}
