<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'person',
        'phone',
        'email',
        'address',                        
    ];   
}
