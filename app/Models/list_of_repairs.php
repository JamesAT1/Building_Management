<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class list_of_repairs extends Model
{
    use HasFactory;
    protected $primaryKey = 'list_repair_id';
    public $timestamps = false;
    protected $fillable = [
        'list_repair_id',
        'date_of_report',
        'list_report',
        'status_repair',
        'notifier',
        'editor',
        'operator',
        'description',
        'approve_report'
    ];
}
