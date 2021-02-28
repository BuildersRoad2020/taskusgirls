<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaultyUnitReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'tasks_id',
        'Address',
        'Notes',
    ];  
}
