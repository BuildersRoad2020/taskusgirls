<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicianRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'warranty',
        'quote',
        'device_disposal',
        'device_name',
        'LTstatus',
        'techs_required',
        'job',
        'issue',
        'Address',
        'L2',
    ];
}
