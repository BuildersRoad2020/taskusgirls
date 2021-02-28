<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'case',
        'store',
        'task_types_id',
        'users_id', //owner
        'admin',
        'status'
    ];

    public function User() {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function Admin() {
        return $this->belongsTo(User::class, 'admin');
    }

    public function TaskType() {
        return $this->belongsTo(TaskType::class, 'task_types_id');
    }

}
