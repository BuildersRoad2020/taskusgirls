<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'tasks_id',
        'RFQ',
        'quote',
        'L2'
    ];    
}
