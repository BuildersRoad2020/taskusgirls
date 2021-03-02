<?php

namespace App\Http\Livewire;

use App\Models\Application;
use App\Models\DeviceType;
use App\Models\FaultyUnitReturn;
use App\Models\HardwareReplacement;
use Livewire\Component;
use App\Models\Tasks;
use App\Models\TaskType;
use App\Models\InvoiceRequest;
use App\Models\ReplacementReason;
use App\Models\SiteAddress;
use App\Models\SolutionType;
use App\Models\TechnicianRequest;
use App\Models\WarrantyRepair;
use App\Models\User;
use Facade\IgnitionContracts\Solution;
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

    //Hardware Replacement Form

public $HRwarranty;
public $HRquote;
public $HRdevice_disposal;
public $HRdevice_name;
public $HRdevice_type;
public $HRLTstatus;
public $HRissue;
public $HRreason;
public $HRconnection_type;
public $HRwifi_name;
public $HRwifi_password;
public $HRnetwork_type;
public $HRIP;
public $HRsubnet;
public $HRDG;
public $HRDNS;
public $HRDNS2;
public $HR7Eleven;
public $HRstore_id;
public $HRpostcode;
public $HRpasscode;
public $HRapplication;
public $HRmatrox;
public $HRsolution_type;
public $HRorientation;
public $HRscreen_model;
public $HRserial_number;
public $HRend;
public $HRnetwork_device_type;
public $HRprojector_model;
public $HRprojector_lamp;
public $HRnotes;
public $HRL2;
public $HRperson;
public $HRphone;
public $HRemail;
public $HRaddress;

//HR View
public $HRView;

//HR Modals
public $HRModal = false;
public $HRwarrantybind = false;
public $HRdevice_typebind1 = false;
    public $HRdevice_typebind1sub = false;
public $HRdevice_typebind2 = false;
    
public $HRdevice_typebind3 = false;
    
public $HRdevice_typebind4 = false;
    
public $HRconnection_typebind = false;    
public $HRnetwork_typebind = false;
public $HRApplicationbind = false;




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
            'devicetypes' => DeviceType::orderBy('name')->get(),
            'replacementreasons' => ReplacementReason::orderBy('name')->get(),
            'applications' => Application::orderBy('name')->get(),
            'solutiontypes' => SolutionType::orderBy('name')->get(),
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
       $HRView = HardwareReplacement::where('tasks_id', $caseID->id)->pluck('id')->first();

      // dd($FUR);

       $this->FUR = $FUR;
       $this->WR = $WR;
       $this->IR = $IR;
       $this->TRView = $TRView;
       $this->HRView = $HRView;

       if($HRView !=null) {

        $id = HardwareReplacement::where('id',$HRView)->first();

        $this->HRwarranty = $id->warranty;
        $this->HRquote = $id->quote;
        $this->HRdevice_disposal = $id->device_disposal;
        $this->HRdevice_name = $id->device_name;
        $this->HRdevice_type = DeviceType::where('id', $id->device_type)->pluck('name')->first();
        $this->HRLTstatus = $id->LTstatus;
        $this->HRissue = $id->issue;
        $this->HRreason = ReplacementReason::where('id', $id->reason)->pluck('name')->first();
        $this->HRconnection_type = $id->connection_type;
        $this->HRwifi_name = $id->wifi_name;
        $this->HRwifi_password = $id->wifi_password;
        $this->HRnetwork_type = $id->network_type;
        $this->HRIP = $id->IP;
        $this->HRsubnet = $id->subnet;
        $this->HRDG = $id->DG;
        $this->HRDNS = $id->DNS;
        $this->HRDNS2 = $id->DNS2;
        $this->HR7Eleven = $id->SevenEleven;
        $this->HRstore_id = $id->store_id;
        $this->HRpostcode = $id->postcode;
        $this->HRpasscode = $id->passcode;
        $this->HRapplication = Application::where('id', $id->application)->pluck('name')->first();
        $this->HRmatrox = $id->matrox;
        $this->HRsolution_type = SolutionType::where('id', $id->solution_type)->pluck('name')->first();
        $this->HRorientation = $id->orientation;
        $this->HRscreen_model = $id->screen_model;
        $this->HRserial_number = $id->serial_number;
        $this->HRend = $id->end;
        $this->HRnetwork_device_type = $id->network_device_type;
        $this->HRprojector_model = $id->projector_model;
        $this->HRprojector_lamp = $id->projector_lamp;
        $this->HRnotes = $id->notes;
        $this->HRL2 = $id->L2;
        $this->HRperson = SiteAddress::where('id', $id->Address)->pluck('person')->first();
        $this->HRphone = SiteAddress::where('id', $id->Address)->pluck('phone')->first();
        $this->HRemail = SiteAddress::where('id', $id->Address)->pluck('email')->first();
        $this->HRaddress = SiteAddress::where('id', $id->Address)->pluck('address')->first();
       }

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
         
         else if ($validatedData['task_id'] == 1) {
            // $this->site = true;
             $this->HRModal = true;
             
             $validatedHardwareReplacement = $this->validate([
                'HRwarranty' => ['required'], //
                'HRquote' => ['required_if:HRwarranty,0'],  //
                'HRdevice_disposal' => ['required'], //
                'HRdevice_name' => ['required'], //
                'HRdevice_type' => ['required'], //
                'HR7Eleven' => ['required_if:HRdevice_type, 1'], //
                'HRstore_id' => ['required_if:HR7Eleven,1'], //
                'HRpostcode' => ['required_if:HR7Eleven,1'],//
                'HRpasscode' => ['required_if:HR7Eleven,1'], //
                'HRscreen_model' => ['required_if:HRdevice_type,2'], //
                'HRserial_number' => ['required_if:HRdevice_type,2'], //
                'HRend' => ['required_if:HRdevice_type,2'], //
                'HRnetwork_device_type' => ['required_if:HRdevice_type,3'], //
                'HRprojector_model' => ['required_if:HRdevice_type,4'], //
                'HRprojector_lamp' => ['required_if:HRdevice_type,4'], //
                'HRLTstatus' => ['required'], //
                'HRissue' => ['required'], //
                'HRreason' => ['required'],
                'HRconnection_type' =>  ['required'],
                'HRwifi_name' => ['required_if:HRconnection_type,1'],
                'HRwifi_password' => ['required_if:HRconnection_type,1'],
                'HRnetwork_type' =>  ['required_if:HRdevice_type ,1'],
                'HRIP' => ['required_if:HRnetwork_type,1'],
                'HRsubnet' => ['required_if:HRnetwork_type,1'],
                'HRDG'  => ['required_if:HRnetwork_type,1'],
                'HRDNS' => ['required_if:HRnetwork_type,1'],
                'HRDNS2'  => ['required_if:HRnetwork_type,1'],
                'HRapplication'  =>  ['required'],
                'HRmatrox' => ['required_if:HRapplication,9'],
                'HRsolution_type' => ['required'],
                'HRorientation' => ['required'],
                'HRnotes' => ['required'],
                'HRL2'  => ['required'],
                'HRphone' => ['required'],
                'HRemail' => ['required'],
                'HRaddress' => ['required'],
                'HRperson' => ['required'],
       
            ]);

            $task->save();
            $address = new SiteAddress;
            $address->person = $validatedHardwareReplacement['HRperson'];
            $address->phone = $validatedHardwareReplacement['HRphone'];
            $address->email = $validatedHardwareReplacement['HRemail'];
            $address->address = $validatedHardwareReplacement['HRaddress'];
            $address->save();
            $hardwarereplacement = new HardwareReplacement;
            $hardwarereplacement->warranty = $validatedHardwareReplacement['HRwarranty'];
            $hardwarereplacement->quote = $validatedHardwareReplacement['HRquote'];
            $hardwarereplacement->device_disposal = $validatedHardwareReplacement['HRdevice_disposal'];
            $hardwarereplacement->device_name = $validatedHardwareReplacement['HRdevice_name'];
            $hardwarereplacement->device_type = $validatedHardwareReplacement['HRdevice_type'];
            $hardwarereplacement->SevenEleven =  $validatedHardwareReplacement['HR7Eleven'];
            $hardwarereplacement->store_id = $validatedHardwareReplacement['HRstore_id'];
            $hardwarereplacement->postcode  = $validatedHardwareReplacement['HRpostcode'];
            $hardwarereplacement->passcode = $validatedHardwareReplacement['HRpasscode'];
            $hardwarereplacement->screen_model = $validatedHardwareReplacement['HRscreen_model'];
            $hardwarereplacement->serial_number =  $validatedHardwareReplacement['HRserial_number'];
            $hardwarereplacement->end =  $validatedHardwareReplacement['HRend'];
            $hardwarereplacement->network_device_type =  $validatedHardwareReplacement['HRnetwork_device_type'];
            $hardwarereplacement->projector_model =  $validatedHardwareReplacement['HRprojector_model'];
            $hardwarereplacement->projector_lamp =  $validatedHardwareReplacement['HRprojector_lamp'];
            $hardwarereplacement->LTstatus = $validatedHardwareReplacement['HRLTstatus'];
            $hardwarereplacement->issue = $validatedHardwareReplacement['HRissue'];
            $hardwarereplacement->reason = $validatedHardwareReplacement['HRreason'];
            $hardwarereplacement->connection_type = $validatedHardwareReplacement['HRconnection_type'];
            $hardwarereplacement->wifi_name = $validatedHardwareReplacement['HRwifi_name'];
            $hardwarereplacement->wifi_password = $validatedHardwareReplacement['HRwifi_password'];
            $hardwarereplacement->network_type = $validatedHardwareReplacement['HRnetwork_type'];            
            $hardwarereplacement->IP = $validatedHardwareReplacement['HRIP'];     
            $hardwarereplacement->subnet = $validatedHardwareReplacement['HRsubnet'];   
            $hardwarereplacement->DG = $validatedHardwareReplacement['HRDG'];   
            $hardwarereplacement->DNS = $validatedHardwareReplacement['HRDNS'];   
            $hardwarereplacement->DNS2 = $validatedHardwareReplacement['HRDNS2'];       
            $hardwarereplacement->application = $validatedHardwareReplacement['HRapplication'];  
            $hardwarereplacement->matrox = $validatedHardwareReplacement['HRmatrox'];  
            $hardwarereplacement->solution_type = $validatedHardwareReplacement['HRsolution_type'];       
            $hardwarereplacement->orientation = $validatedHardwareReplacement['HRorientation'];         
            $hardwarereplacement->L2 = $validatedHardwareReplacement['HRL2'];   
            $hardwarereplacement->notes = $validatedHardwareReplacement['HRnotes'];   
            $hardwarereplacement->tasks_id = $task->id;    
            $hardwarereplacement->address = $address->id;  
            $hardwarereplacement->save();
            $this->HRModal = true;
         }
 

        $this->confirmAdd = false;
        $this->reset('store');
        $this->reset('task_id');
        $this->reset('case');

        session()->flash('message', 'Task has been added');
    }


}
