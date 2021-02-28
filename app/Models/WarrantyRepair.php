<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarrantyRepair extends Model
{
    use HasFactory;

    protected $fillable = [
        'reason',
        'software',
        'firmware',
        'brand',
        'model',
        'serial',
        'start',
        'end',
        'L2',
        'Address',
    ];    
}
