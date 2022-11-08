<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;
    protected $fillable = [
       'emp_no',
       'ac_no',
       'no',
       'name',
       'auto_assign',
       'date',
       'timetable'
    ];

    protected $casts = [
        'date'  => 'date:d/m/Y',
    ];
}
