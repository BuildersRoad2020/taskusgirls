<?php

namespace App\Http\Livewire;

use App\Models\FaultyUnitReturn;
use Livewire\Component;
use App\Models\Tasks;
use App\Models\TaskType;
use App\Models\InvoiceRequest;
use App\Models\SiteAddress;
use App\Models\TechnicianRequest;
use App\Models\WarrantyRepair;
use App\Models\User;


use Livewire\WithPagination;

class AdminDashboard extends Component
{
    use WithPagination;

    public $status; //toggle task status
    public $q; //searchbox
    public $task_types_id;
    public $Delete = false;
    public $View = false;

    public $confirmGrab = false;
    public $confirmDone = false;

    public $confirmAdd = false; //creates case modal
    public $invoicerequest = false; //creates invoice state
    public $warrantyrepair = false; //creates warranty repair states
    public $unitreturn = false; //creates faulty unit return states
    public $site = false; //creates address state
    public $TR = false; //creates tech request state
        public $TRWarranty = false; //sub state for $TR


    //ViewForm
    public $viewCase;
    public $viewStore;
    public $viewTask;
    public $viewUser;
    public $viewAdmin;
    public $viewStatus;

    //VIEWFORM
    /* FUR */
  
    public $FUR;
    public $FURAddress;
    public $FURNotes;
    public $FURPerson;
    public $FURPhone;
    public $FUREmail;
    public $FURAddressComplete;
    
    /* WR  */
    public $WR;
    public $WRReason;
    public $WRSoftware;
    public $WRFirmware;
    public $WRBrand;
    public $WRModel;
    public $WRSerial;
    public $WRStart;
    public $WREnd;
    public $WRAddress;
    public $WRL2;
    public $WRPerson;
    public $WRPhone;
    public $WREmail;

    /* IR */
    public $IR;
    public $IRRFQ;
    public $IRQuote;  

    /*TR */
    public $TRView;
    public $TRPerson;
    public $TRPhone;
    public $TREmail;
    public $TRWarrantyView;
    public $TRQuote;
    public $TRDevice_Disposal;
    public $TRDevice_Name;
    public $TRLTStatus;
    public $TRTechs_Required;
    public $TRJob;
    public $TRIssue;
    public $TRAddress;

    //Site Address form
    public $person;
    public $phone;
    public $email;
    public $address;

    //Unitreturn form
    public $notes;

    //Task Form
    public $case;
    public $store;
    public $task_id;
    public $admin;

    //Invoice Request Form
    public $RFQ;
    public $quote;

    //Warranty Repair
    public $reason;
    public $software;
    public $firmware;
    public $brand;
    public $model;
    public $serial;
    public $start;
    public $end;
    public $L2;
 

    //Tech Request
    public $warranty;
    public $quoteTR;
    public $device_disposal;
    public $device_name;
    public $LTstatus;
    public $techs_required;
    public $job;
    public $issue;
    public $personTR;
    public $phoneTR;
    public $emailTR;
    public $addressTR;



    // public $rules = [

    protected $queryString = [  //to show query in url
        'status',
        'q',
        'task_types_id',
    ];

    public function render()
    {
        $tasks = Tasks::with('User')->with('TaskType')->with('Admin')->Orderby('created_at', 'DESC')
            ->when($this->q, function ($query) {
                return $query->where(function ($query) {
                    $query->where('case', 'LIKE', '%' . $this->q . '%');
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
            ->paginate('10');


        return view('livewire.admin-dashboard', [
            'tasks' => $tasks,
            'tasktypes' => TaskType::orderBy('name')->get(),
        ]);
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function updatingTask_types_id()
    {
        $this->resetPage();
    }

    public function confirmView($id)
    {
       // dd($id);
      //  dd($id);
       $this->View = $id;
       $caseID = Tasks::where('id', $id)->first();

       $FUR = FaultyUnitReturn::where('tasks_id', $caseID->id)->pluck('id')->first();
       $WR = WarrantyRepair::where('tasks_id', $caseID->id)->pluck('id')->first();
       $IR = InvoiceRequest::where('tasks_id', $caseID->id)->pluck('id')->first();
       $TRView = TechnicianRequest::where('tasks_id', $caseID->id)->pluck('id')->first();

      // dd($FUR);

       $this->FUR = $FUR;
       $this->WR = $WR;
       $this->IR = $IR;
       $this->TRView = $TRView;

       if ($FUR != null) {
   
           $FURid = FaultyUnitReturn::where('id',$FUR)->first();
           $this->FURAddress = $FURid->Address;
           $this->FURNotes = $FURid->Notes;
           $this->FURPerson = SiteAddress::where('id', $FURid->Address)->pluck('person')->first();
           $this->FURPhone = SiteAddress::where('id', $FURid->Address)->pluck('phone')->first();
           $this->FUREmail = SiteAddress::where('id', $FURid->Address)->pluck('email')->first();
           $this->FURAddressComplete = SiteAddress::where('id', $FURid->Address)->pluck('address')->first();
       }

       if ($WR != null) {
           $WRid = WarrantyRepair::where('id', $WR)->first();
           $this->WRReason = $WRid->reason;
           $this->WRSoftware = $WRid->software;
           $this->WRFirmware = $WRid->firmware;
           $this->WRBrand = $WRid->brand;
           $this->WRModel = $WRid->model;
           $this->WRSerial = $WRid->serial;
           $this->WRStart = $WRid->start;
           $this->WREnd = $WRid->end;
           $this->WRAddress = SiteAddress::where('id', $WRid->Address)->pluck('address')->first();    
           $this->WRL2 = $WRid->L2;
           $this->WRPerson = SiteAddress::where('id', $WRid->Address)->pluck('person')->first();
           $this->WRPhone = SiteAddress::where('id', $WRid->Address)->pluck('phone')->first();
           $this->WREmail = SiteAddress::where('id', $WRid->Address)->pluck('email')->first();       
       }

       if ($IR != null) {
           $IRid = InvoiceRequest::where('id',$IR)->first();
           $this->IRRFQ = $IRid->RFQ;
           $this->IRQuote = $IRid->quote;
       }

       if ($TRView != null) {
           $TRid = TechnicianRequest::where('id',$TRView)->first();
           $this->TRPerson = SiteAddress::where('id', $TRid->Address)->pluck('person')->first();
           $this->TRPhone = SiteAddress::where('id', $TRid->Address)->pluck('phone')->first();
           $this->TREmail = SiteAddress::where('id', $TRid->Address)->pluck('email')->first();  
           $this->TRAddress = SiteAddress::where('id', $TRid->Address)->pluck('address')->first();  
           $this->TRWarrantyView = $TRid->warranty;
           $this->TRQuote = $TRid->quote;
           $this->TRDevice_Disposal = $TRid->device_disposal;
           $this->TRDevice_Name = $TRid->device_name;
           $this->TRLTStatus = $TRid->LTstatus;
           $this->TRTechs_Required = $TRid->techs_required;
           $this->TRJob = $TRid->job;
           $this->TRIssue = $TRid->issue;
       }

      $this->viewCase = Tasks::where('id', $caseID->id)->pluck('case')->first();
      $this->viewStore = Tasks::where('id', $caseID->id)->pluck('store')->first();
      $this->viewTask = TaskType::where('id', $caseID->task_types_id)->pluck('name')->first();
      $this->viewUser = User::where('id', $caseID->users_id)->pluck('name')->first();
      $this->viewStatus = Tasks::where('id', $caseID->id)->pluck('status')->first(); 
      $this->viewAdmin = User::where('id', $caseID->admin)->pluck('name')->first();
    }

    public function confirmingGrab($id) 
    {
        $this->reset('confirmGrab');
        $this->confirmGrab = $id;
    }


    public function Grab(Tasks $id) {
       // dd($id);
        $update = Tasks::find($id->id);
        $update->admin = auth()->user()->id;
        $update->status = '1';
        $update->save();

        $this->confirmGrab = false;
        session()->flash('message', 'You have grabbed the task');
    }

    public function confirmingDone($id) 
    {
        $this->reset('confirmGrab');
        $this->confirmDone = $id;
    }


    public function Done(Tasks $id) {
       // dd($id);
        $update = Tasks::find($id->id);
        $update->status = '2';
        $update->save();

        $this->confirmDone = false;
        session()->flash('message', 'Contratulations! You have completed the task');
    }

    public function confirmDelete($id)
    {
        $this->Delete = $id;
    }

    public function DeleteTask(Tasks $id)
    {
        $id->delete();
        $this->Delete = false;
        session()->flash('message', 'Task has been deleted');
    }

    public function confirmingAdd()
    {
        $this->resetPage();
        $this->confirmAdd = true;
    }

    public function AddTask()
    {
      
        $validatedData =  $this->validate(
            [
                'case' => ['required'],
                'store' => ['required'],
                'task_id' =>  ['required']
            ]
        );

        $task = new Tasks;
        $task->case = $validatedData['case'];
        $task->store = $validatedData['store'];
        $task->task_types_id = $validatedData['task_id'];
        $task->users_id = auth()->user()->id;

        if ($validatedData['task_id'] == 5) {

            $this->invoicerequest = true;
            $validatedInvoice = $this->validate([
                'RFQ' => ['required'],
                'quote' => ['required']
            ]);
            $task->save();
            $invoice = new InvoiceRequest;
            $invoice->RFQ = $validatedInvoice['RFQ'];
            $invoice->quote = $validatedInvoice['quote'];
            $invoice->tasks_id = $task->id;
            $invoice->save();
            $this->invoicerequest = false;
            $this->reset('RFQ');
            $this->reset('quote');
        } else if ($validatedData['task_id'] == 4) {

            $this->warrantyrepair = true;
            $this->site = true;
            $validatedWarrantyRepair = $this->validate([
                'reason' => ['required'],
                'software' => ['required'],
                'firmware' => ['required'],
                'brand' => ['required'],
                'model' => ['required'],
                'serial' => ['required'],
                'start' => ['required'],
                'end' => ['required'],
                'L2' => ['required'],
                'person' => ['required'],
                'phone' => ['required', 'numeric'],
                'email' => ['required', 'email'],
                'address' => ['required'],
            ]);
            $task->save();
            $address = new SiteAddress;
            $address->person = $validatedWarrantyRepair['person'];
            $address->phone = $validatedWarrantyRepair['phone'];
            $address->email = $validatedWarrantyRepair['email'];
            $address->address = $validatedWarrantyRepair['address'];
            $address->save();
            $warranty = new WarrantyRepair;
            $warranty->reason = $validatedWarrantyRepair['reason'];
            $warranty->software = $validatedWarrantyRepair['software'];
            $warranty->firmware = $validatedWarrantyRepair['firmware'];
            $warranty->brand = $validatedWarrantyRepair['brand'];
            $warranty->model = $validatedWarrantyRepair['model'];
            $warranty->serial = $validatedWarrantyRepair['serial'];
            $warranty->start = $validatedWarrantyRepair['start'];
            $warranty->end = $validatedWarrantyRepair['end'];
            $warranty->L2 = $validatedWarrantyRepair['L2'];
            $warranty->Address = $address->id;
            $warranty->tasks_id = $task->id;
            $warranty->save();
            $this->warrantyrepair = false;
            $this->site = false;
            $this->reset('reason');
            $this->reset('software');
            $this->reset('firmware');
            $this->reset('brand');
            $this->reset('model');
            $this->reset('serial');
            $this->reset('start');
            $this->reset('end');
            $this->reset('L2');
            $this->reset('person');
            $this->reset('phone');
            $this->reset('email');
            $this->reset('address');
        } else if ($validatedData['task_id'] == 3) {
            $this->site = true;
            $this->unitreturn = true;

            $validatedUnitReturn = $this->validate([
                'person' => ['required'],
                'phone' => ['required', 'numeric'],
                'email' => ['required', 'email'],
                'address' => ['required'],
                'notes' => ['required']
            ]);
            $task->save();
            $address = new SiteAddress;
            $address->person = $validatedUnitReturn['person'];
            $address->phone = $validatedUnitReturn['phone'];
            $address->email = $validatedUnitReturn['email'];
            $address->address = $validatedUnitReturn['address'];
            $address->save();
            $unitreturn = new FaultyUnitReturn;
            $unitreturn->tasks_id = $task->id;
            $unitreturn->Address = $address->id;
            $unitreturn->Notes = $validatedUnitReturn['notes'];
            $unitreturn->save();
            $this->reset('person');
            $this->reset('phone');
            $this->reset('email');
            $this->reset('address');
            $this->reset('notes');
            $this->site = false;
            $this->unitreturn = false;
        }

        else if ($validatedData['task_id'] == 2) {
           // $this->site = true;
            $this->TR = true;

            $validatedTechRequest = $this->validate([
                'personTR' => ['required'],
                'phoneTR' => ['required', 'numeric'],
                'emailTR' => ['required', 'email'],
                'addressTR' => ['required'],
                'warranty' => ['required',
                            function ($attribute, $value, $fail) {
                                if($value == 0) {
                                    $this->TRWarranty = true;
                                }
                            }],
                'quoteTR' => ['required_if:warranty,0'],
                'device_disposal' => ['required'],
                'device_name' => ['required'],
                'LTstatus' => ['required'],
                'techs_required' => ['required', 'numeric'],
                'job' => ['required'],
                'issue' => ['required'],
            ]);

            $task->save();
            $address = new SiteAddress;
            $address->person = $validatedTechRequest['personTR'];
            $address->phone = $validatedTechRequest['phoneTR'];
            $address->email = $validatedTechRequest['emailTR'];
            $address->address = $validatedTechRequest['addressTR'];
            $address->save();
            $techrequest = new TechnicianRequest;
            $techrequest->warranty = $validatedTechRequest['warranty'];
            $techrequest->quote = $validatedTechRequest['quoteTR'];
            $techrequest->device_disposal = $validatedTechRequest['device_disposal'];
            $techrequest->device_name = $validatedTechRequest['device_name'];
            $techrequest->LTstatus = $validatedTechRequest['LTstatus'];
            $techrequest->techs_required = $validatedTechRequest['techs_required'];
            $techrequest->job = $validatedTechRequest['job'];
            $techrequest->address = $address->id;
            $techrequest->issue = $validatedTechRequest['issue'];
            $techrequest->tasks_id = $task->id;
            $techrequest->save();
            $this->TR = false;
            $this->TRWarranty = false;
            $this->reset('personTR');
            $this->reset('phoneTR');
            $this->reset('emailTR');
            $this->reset('addressTR');
            $this->reset('warranty');
            $this->reset('quoteTR');
            $this->reset('device_disposal');
            $this->reset('device_name');
            $this->reset('LTstatus');
            $this->reset('techs_required');
            $this->reset('job');
            $this->reset('issue');
            
         } 
 

        $this->confirmAdd = false;
        $this->reset('store');
        $this->reset('task_id');
        $this->reset('case');

        session()->flash('message', 'Task has been added');
    }


}
