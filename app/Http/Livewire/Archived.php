<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Application;
use App\Models\DeviceType;
use App\Models\FaultyUnitReturn;
use App\Models\HardwareReplacement;
use App\Models\Tasks;
use App\Models\TaskType;
use App\Models\InvoiceRequest;
use App\Models\ReplacementReason;
use App\Models\ReturnAuthorization;
use App\Models\RoleUser;
use App\Models\SiteAddress;
use App\Models\SolutionType;
use App\Models\SOwithTech;
use App\Models\SupportType;
use App\Models\TechnicianRequest;
use App\Models\WarrantyRepair;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Livewire\WithPagination;

class Archived extends Component

{

    public $status; //toggle task status
    public $q; //searchbox
    public $task_types_id;
    public $owners;
    public $admins;

    public $confirmGrab = false;
  
    protected $queryString = [  //to show query in url
        'status',
        'q',
        'task_types_id',
        'owners',
        'admins'
    ];

    use AuthorizesRequests;
    use WithPagination;

    public function render()
    { 
            $tasks = Tasks::with('User')->with('TaskType')->with('Admin')->Orderby('status', 'ASC')->Orderby('created_at', 'DESC')
                ->where('status', 4)
                ->when($this->q, function ($query) {
                    return $query->where(function ($query) {
                        $query->where('casenumber', 'LIKE', '%' . $this->q . '%')->orwhere('store', 'LIKE', '%' . $this->q . '%');
                    });
                })
                ->when($this->status, function ($query) {
                    return $query->where(function ($query) {
                        $query->where('status', 'LIKE', '%' . $this->status . '%');
                    });
                })
                ->when($this->task_types_id, function ($query) {
                    return $query->where(function ($query) {
                        $query->where('task_types_id', 'LIKE', '%' . $this->task_types_id . '%');
                    });
                })
                ->when($this->owners, function ($query) {
                    return $query->where(function ($query) {
                        $query->where('users_id', 'LIKE', '%' . $this->owners . '%');
                    });
                })
                ->when($this->admins, function ($query) {
                    return $query->where(function ($query) {
                        $query->where('admin', 'LIKE', '%' . $this->admins . '%');
                    });
                })
                ->paginate('20');

            return view('livewire.archived', [
                'tasks' => $tasks,
                'tasktypes' => TaskType::orderBy('name')->get(),
                'devicetypes' => DeviceType::orderBy('name')->get(),
                'replacementreasons' => ReplacementReason::orderBy('name')->get(),
                'applications' => Application::orderBy('name')->get(),
                'solutiontypes' => SolutionType::orderBy('name')->get(),
                'owner' => User::orderBy('name')->whereHas('RoleUser', function ($q) {
                    $q->where('roles_id', '2');
                })->get(),
                'admin' => User::orderBy('name')->whereHas('RoleUser', function ($q) {
                    $q->where('roles_id', '1');
                })->get(),
                'supporttypes' => SupportType::get(),
                'L2' => User::orderBy('name')->whereHas('RoleUser', function ($q) {
                    $q->where('roles_id', '3');
                })->get(),
            ]);
        
    }

    public function confirmingGrab($id) 
    {
        $this->authorize('viewAny', App\Models\User::class); 
        $this->reset('confirmGrab');
        $this->confirmGrab = $id;
    }

    public function Grab(Tasks $id) {
       // dd($id);
        $this->authorize('viewAny', App\Models\User::class); 
        $update = Tasks::find($id->id);
        $update->admin = auth()->user()->id;
        $update->status = '0';
        $update->save();

        $this->confirmGrab = false;
        session()->flash('message', 'Task restored');
    }
}
