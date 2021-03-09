<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Tasks extends Model
{
    use HasFactory;

    public $identifyDuplicate;

    protected $fillable = [
        'id',
        'casenumber',
        'store',
        'task_types_id',
        'users_id', //owner
        'admin',
        'status',
        'notes',
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

    public function identifyDuplicate() {
      
       $identifyDuplicate = DB::table('tasks')->wherein('casenumber', function ($query) {     
       $query->select('casenumber')->from('tasks')->groupBy('casenumber')->havingRaw('COUNT(casenumber) > 1')->get();})->get()->pluck('casenumber');
          
      return $identifyDuplicate;

    }


}
