<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Guest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'birthday',
        'gender'
    ];

}
