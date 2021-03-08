<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnAuthorization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tasks_id',
        'serial_number',
    ];


}
