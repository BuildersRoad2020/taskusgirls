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


class Dashboard extends Component

{

    use AuthorizesRequests;
    public $status; //toggle task status
    public $q; //searchbox
    public $task_types_id;
    public $owners;
    public $admins;

    public $confirmAdd = false;
    public $Archive = false;
    public $confirmGrab = false;
    public $confirmDone = false;
    public $View = false;

    protected $queryString = [  //to show query in url
        'status',
        'q',
        'task_types_id',
        'owners',
        'admins'
    ];

    /* View Form */
    public $FUR;
    public $HR;
    public $HRWT;
    public $IR;
    public $RA;
    public $TR;
    public $WR;

    /* Task Table */
    public $addhardwarereplacement = false;
    public $addtechnicianrequest = false;
    public $addfaultyunityreturn = false;
    public $addwarrantyrepair = false;
    public $addinvoicerequest = false;
    public $addhardwareplacementwithtech = false;
    public $addreturnauthorization = false;

    /* Task Table */
    public $casenumber;
    public $store;
    public $task_id;
    public $users_id;
    public $admin_assigned;
    public $notes;
    public $casestatus;

    /* Hardware Replacement */
    public $hardwareplacement;
    public $hardwareplacementsupport_types_id;
    public $hardwareplacementwarranty;
    public $hardwareplacementquote;
    public $hardwareplacementdevice_disposal;
    public $hardwareplacementdevice_name;
    public $hardwareplacementdevice_type;
    public $hardwareplacementLTstatus;
    public $hardwareplacementissue;
    public $hardwareplacementreason;
    public $hardwareplacementconnection_type;
    public $hardwareplacementwifi_name;
    public $hardwareplacementwifi_password;
    public $hardwareplacementnetwork_type;
    public $hardwareplacementIP;
    public $hardwareplacementsubnet;
    public $hardwareplacementDG;
    public $hardwareplacementDNS;
    public $hardwareplacementDNS2;
    public $hardwareplacementSevenEleven;
    public $hardwareplacementstore_id;
    public $hardwareplacementpasscode;
    public $hardwareplacementpostcode;
    public $hardwareplacementapplication;
    public $hardwareplacementmatrox;
    public $hardwareplacementsolution_type;
    public $hardwareplacementorientation;
    public $hardwareplacementscreen_model;
    public $hardwareplacementserial_number;
    public $hardwareplacementend;
    public $hardwareplacementnetwork_device_type;
    public $hardwareplacementprojector_model;
    public $hardwareplacementprojector_lamp;
    public $hardwareplacementnotes;
    public $hardwareplacementL2;
    public $hardwareplacementperson;
    public $hardwareplacementphone;
    public $hardwareplacementemail;
    public $hardwareplacementaddress;

    /* Technician Request */
    public $technicianrequestwarranty;
    public $technicianrequestquote;
    public $technicianrequestdevice_disposal;
    public $technicianrequestdevice_name;
    public $technicianrequestdevice_type;
    public $technicianrequestLTstatus;
    public $technicianrequesttechs_required;
    public $technicianrequestjob;
    public $technicianrequestissue;
    public $technicianrequestL2;
    public $technicianrequestsupport_types_id;
    public $technicianrequesttools;
    public $technicianrequestdisplay_status;
    public $technicianrequestperson;
    public $technicianrequestphone;
    public $technicianrequestemail;
    public $technicianrequestaddress;

    /* Faulty Unit Return */
    public $faultyunitreturnperson;
    public $faultyunitreturnphone;
    public $faultyunitreturnemail;
    public $faultyunitreturnaddress;
    public $faultyunitreturnnotes;

    /* Warranty Repair */
    public $warrantyrepairreason;
    public $warrantyrepairsoftware;
    public $warrantyrepairfirmware;
    public $warrantyrepairbrand;
    public $warrantyrepairmodel;
    public $warrantyrepairserial;
    public $warrantyrepairstart;
    public $warrantyrepairend;
    public $warrantyrepairperson;
    public $warrantyrepairphone;
    public $warrantyrepairemail;
    public $warrantyrepairaddress;
    public $warrantyrepairL2;

    /* Invoice Request  */
    public $invoicerequestRFQ;
    public $invoicerequestquote;

    /* Return Authorization  */
    public $returnauthorizationname;
    public $returnauthorizationserial_number;

    /* SO with Tech   */
    public $sowithtechsupport_types_id;
    public $sowithtechwarranty;
    public $sowithtechquote;
    public $sowithtechdevice_disposal;
    public $sowithtechdevice_name;
    public $sowithtechdevice_type;
    public $sowithtechLTstatus;
    public $sowithtechissue;
    public $sowithtechreason;
    public $sowithtechconnection_type;
    public $sowithtechwifi_name;
    public $sowithtechwifi_password;
    public $sowithtechnetwork_type;
    public $sowithtechIP;
    public $sowithtechsubnet;
    public $sowithtechDG;
    public $sowithtechDNS;
    public $sowithtechDNS2;
    public $sowithtechSevenEleven;
    public $sowithtechstore_id;
    public $sowithtechpasscode;
    public $sowithtechpostcode;
    public $sowithtechapplication;
    public $sowithtechmatrox;
    public $sowithtechsolution_type;
    public $sowithtechorientation;
    public $sowithtechscreen_model;
    public $sowithtechserial_number;
    public $sowithtechend;
    public $sowithtechnetwork_device_type;
    public $sowithtechprojector_model;
    public $sowithtechprojector_lamp;
    public $sowithtechnotes;
    public $sowithtechL2;
    public $sowithtechperson;
    public $sowithtechphone;
    public $sowithtechemail;
    public $sowithtechaddress;

    public $sowithtechtechs_required;
    public $sowithtechjob;
    public $sowithtechtools;
    public $sowithtechdisplay_status;

    use WithPagination;

    public function render()
    {
        $tasks = Tasks::with('User')->with('TaskType')->with('Admin')->Orderby('status', 'ASC')->Orderby('created_at', 'DESC')     
        ->wherein('status', [0, 1, 2])
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

        return view('livewire.dashboard', [
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

    public function confirmView($id)
    {
      //  dd($id);
       $this->View = $id;
       $caseID = Tasks::where('id', $id)->first();

       $FUR = FaultyUnitReturn::where('tasks_id', $caseID->id)->pluck('id')->first();
       $HR = HardwareReplacement::where('tasks_id', $caseID->id)->pluck('id')->first();
       $HRWT = SOwithTech::where('tasks_id', $caseID->id)->pluck('id')->first();
       $IR = InvoiceRequest::where('tasks_id', $caseID->id)->pluck('id')->first();
       $RA = ReturnAuthorization::where('tasks_id', $caseID->id)->pluck('id')->first();
       $TR = TechnicianRequest::where('tasks_id', $caseID->id)->pluck('id')->first();
       $WR = WarrantyRepair::where('tasks_id', $caseID->id)->pluck('id')->first();
  
       $this->FUR = $FUR;
       $this->HR = $HR;
       $this->HRWT = $HRWT;
       $this->IR = $IR;
       $this->RA = $RA;
       $this->TR = $TR;
       $this->WR = $WR;

       if ($FUR != null) {
        $FURid = FaultyUnitReturn::where('id',$FUR)->first();
        $this->faultyunitreturnnotes = $FURid->Notes;
        $this->faultyunitreturnperson = SiteAddress::where('id', $FURid->Address)->pluck('person')->first();
        $this->faultyunitreturnphone = SiteAddress::where('id', $FURid->Address)->pluck('phone')->first();
        $this->faultyunitreturnemail = SiteAddress::where('id', $FURid->Address)->pluck('email')->first();
        $this->faultyunitreturnaddress = SiteAddress::where('id', $FURid->Address)->pluck('address')->first();

       }

       if ($HR != null) {
        $id = HardwareReplacement::where('id', $HR)->first();

        $this->hardwareplacementwarranty = $id->warranty;
        $this->hardwareplacementquote = $id->quote;
        $this->hardwareplacementdevice_disposal = $id->device_disposal;
        $this->hardwareplacementdevice_name = $id->device_name;
        $this->hardwareplacementdevice_type = DeviceType::where('id', $id->device_type)->pluck('name')->first();
        $this->hardwareplacementLTstatus = $id->LTstatus;
        $this->hardwareplacementissue = $id->issue;
        $this->hardwareplacementreason = ReplacementReason::where('id', $id->reason)->pluck('name')->first();
        $this->hardwareplacementconnection_type = $id->connection_type;
        $this->hardwareplacementwifi_name = $id->wifi_name;
        $this->hardwareplacementwifi_password = $id->wifi_password;
        $this->hardwareplacementnetwork_type = $id->network_type;
        $this->hardwareplacementIP = $id->IP;
        $this->hardwareplacementsubnet = $id->subnet;
        $this->hardwareplacementDG = $id->DG;
        $this->hardwareplacementDNS = $id->DNS;
        $this->hardwareplacementDNS2 = $id->DNS2;
        $this->hardwareplacementSevenEleven = $id->SevenEleven;
        $this->hardwareplacementstore_id = $id->store_id;
        $this->hardwareplacementpostcode = $id->postcode;
        $this->hardwareplacementpasscode = $id->passcode;
        $this->hardwareplacementapplication = Application::where('id', $id->application)->pluck('name')->first();
        $this->hardwareplacementmatrox = $id->matrox;
        $this->hardwareplacementsolution_type = SolutionType::where('id', $id->solution_type)->pluck('name')->first();
        $this->hardwareplacementorientation = $id->orientation;
        $this->hardwareplacementscreen_model = $id->screen_model;
        $this->hardwareplacementserial_number = $id->serial_number;
        $this->hardwareplacementend = $id->end;
        $this->hardwareplacementnetwork_device_type = $id->network_device_type;
        $this->hardwareplacementprojector_model = $id->projector_model;
        $this->hardwareplacementprojector_lamp = $id->projector_lamp;
        $this->hardwareplacementnotes = $id->notes;
        $this->hardwareplacementL2 = User::where('id', $id->L2)->pluck('name')->first();
        $this->hardwareplacementperson = SiteAddress::where('id', $id->Address)->pluck('person')->first();
        $this->hardwareplacementphone = SiteAddress::where('id', $id->Address)->pluck('phone')->first();
        $this->hardwareplacementemail = SiteAddress::where('id', $id->Address)->pluck('email')->first();
        $this->hardwareplacementaddress = SiteAddress::where('id', $id->Address)->pluck('address')->first();
        $this->hardwareplacementsupport_types_id = SupportType::where('id', $id->support_types_id)->pluck('name')->first();
       
       }

       if ($HRWT != null) {

        $id = SOwithTech::where('id', $HRWT)->first();

        $this->sowithtechwarranty = $id->warranty;
        $this->sowithtechquote = $id->quote;
        $this->sowithtechdevice_disposal = $id->device_disposal;
        $this->sowithtechdevice_name = $id->device_name;
        $this->sowithtechdevice_type = DeviceType::where('id', $id->device_type)->pluck('name')->first();
        $this->sowithtechLTstatus = $id->LTstatus;
        $this->sowithtechissue = $id->issue;
        $this->sowithtechreason = ReplacementReason::where('id', $id->reason)->pluck('name')->first();
        $this->sowithtechconnection_type = $id->connection_type;
        $this->sowithtechwifi_name = $id->wifi_name;
        $this->sowithtechwifi_password = $id->wifi_password;
        $this->sowithtechnetwork_type = $id->network_type;
        $this->sowithtechIP = $id->IP;
        $this->sowithtechsubnet = $id->subnet;
        $this->sowithtechDG = $id->DG;
        $this->sowithtechDNS = $id->DNS;
        $this->sowithtechDNS2 = $id->DNS2;
        $this->sowithtechSevenEleven = $id->SevenEleven;
        $this->sowithtechstore_id = $id->store_id;
        $this->sowithtechpostcode = $id->postcode;
        $this->sowithtechpasscode = $id->passcode;
        $this->sowithtechapplication = Application::where('id', $id->application)->pluck('name')->first();
        $this->sowithtechmatrox = $id->matrox;
        $this->sowithtechsolution_type = SolutionType::where('id', $id->solution_type)->pluck('name')->first();
        $this->sowithtechorientation = $id->orientation;
        $this->sowithtechscreen_model = $id->screen_model;
        $this->sowithtechserial_number = $id->serial_number;
        $this->sowithtechend = $id->end;
        $this->sowithtechnetwork_device_type = $id->network_device_type;
        $this->sowithtechprojector_model = $id->projector_model;
        $this->sowithtechprojector_lamp = $id->projector_lamp;
        $this->sowithtechnotes = $id->notes;
        $this->sowithtechL2 = User::where('id', $id->L2)->pluck('name')->first();
        $this->sowithtechperson = SiteAddress::where('id', $id->Address)->pluck('person')->first();
        $this->sowithtechphone = SiteAddress::where('id', $id->Address)->pluck('phone')->first();
        $this->sowithtechemail = SiteAddress::where('id', $id->Address)->pluck('email')->first();
        $this->sowithtechaddress = SiteAddress::where('id', $id->Address)->pluck('address')->first();
        $this->sowithtechsupport_types_id = SupportType::where('id', $id->support_types_id)->pluck('name')->first();
    
        $this->sowithtechtechs_required = $id->techs_required;
        $this->sowithtechjob = $id->job;
        $this->sowithtechtools = $id->tools;
        $this->sowithtechdisplay_status = $id->display_status;
    

       }

       if ($IR != null) {
        $IRid = InvoiceRequest::where('id',$IR)->first();
        $this->invoicerequestRFQ = $IRid->RFQ;
        $this->invoicerequestquote = $IRid->quote;

       }

       if ($RA != null) {
           $RAid = ReturnAuthorization::where('id', $RA)->first();
           $this->returnauthorizationserial_number = $RAid->serial_number;

       }

       if ($TR != null) {

        $TRid = TechnicianRequest::where('id',$TR)->first();
        $this->technicianrequestperson = SiteAddress::where('id', $TRid->Address)->pluck('person')->first();
        $this->technicianrequestphone = SiteAddress::where('id', $TRid->Address)->pluck('phone')->first();
        $this->technicianrequestemail = SiteAddress::where('id', $TRid->Address)->pluck('email')->first();  
        $this->technicianrequestaddress = SiteAddress::where('id', $TRid->Address)->pluck('address')->first();  
        $this->technicianrequestwarranty = $TRid->warranty;
        $this->technicianrequestquote = $TRid->quote;
        $this->technicianrequestdevice_disposal = $TRid->device_disposal;
        $this->technicianrequestdevice_name = $TRid->device_name;
        $this->technicianrequestLTstatus = $TRid->LTstatus;
        $this->technicianrequesttechs_required = $TRid->techs_required;
        $this->technicianrequestjob = $TRid->job;
        $this->technicianrequestissue = $TRid->issue;
        $this->technicianrequestL2 = User::where('id', $TRid->L2)->pluck('name')->first();
        $this->technicianrequestdevice_type = DeviceType::where('id', $TRid->device_type)->pluck('name')->first();
        $this->technicianrequestsupport_types_id = SupportType::where('id', $TRid->support_types_id)->pluck('name')->first();
        $this->technicianrequesttools = $TRid->tools;
        $this->technicianrequestdisplay_status = $TRid->display_status;

       }

       if ($WR != null) {

        $WRid = WarrantyRepair::where('id', $WR)->first();
        $this->warrantyrepairreason = $WRid->reason;
        $this->warrantyrepairsoftware = $WRid->software;
        $this->warrantyrepairfirmware = $WRid->firmware;
        $this->warrantyrepairbrand = $WRid->brand;
        $this->warrantyrepairmodel = $WRid->model;
        $this->warrantyrepairserial = $WRid->serial;
        $this->warrantyrepairstart = $WRid->start;
        $this->warrantyrepairend = $WRid->end;
        $this->warrantyrepairaddress = SiteAddress::where('id', $WRid->Address)->pluck('address')->first();    
        $this->warrantyrepairL2 = User::where('id', $WRid->L2)->pluck('name')->first();
        $this->warrantyrepairperson = SiteAddress::where('id', $WRid->Address)->pluck('person')->first();
        $this->warrantyrepairphone = SiteAddress::where('id', $WRid->Address)->pluck('phone')->first();
        $this->warrantyrepairemail = SiteAddress::where('id', $WRid->Address)->pluck('email')->first();    
       }
       
      $this->casenumber = Tasks::where('id', $caseID->id)->pluck('casenumber')->first();
      $this->store = Tasks::where('id', $caseID->id)->pluck('store')->first();
      $this->task_id = TaskType::where('id', $caseID->task_types_id)->pluck('name')->first();
      $this->users_id = User::where('id', $caseID->users_id)->pluck('name')->first();
      $this->casestatus = Tasks::where('id', $caseID->id)->pluck('status')->first(); 
      $this->admin_assigned = User::where('id', $caseID->admin)->pluck('name')->first();

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
        $update->status = '1';
        $update->save();

        $this->confirmGrab = false;
        session()->flash('message', 'You have grabbed the task');
    }

    public function confirmingDone($id) 
    {
        $this->authorize('viewAny', App\Models\User::class); 
        $this->reset('confirmGrab');
        $this->confirmDone = $id;
    }


    public function Done(Tasks $id) {
       // dd($id);
        $this->authorize('viewAny', App\Models\User::class); 
        $update = Tasks::find($id->id);
        $update->status = '2';
        $update->save();

        $this->confirmDone = false;
        session()->flash('message', 'Contratulations! You have completed the task');
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

    public function updatingOwners()
    {
        $this->resetPage();
    }

    public function updatingAdmins()
    {
        $this->resetPage();
    }

    public function confirmingAdd()
    {
        $this->reset('task_id');
        $this->reset('hardwareplacement');
        $this->reset('hardwareplacementsupport_types_id');
        $this->reset('hardwareplacementwarranty');
        $this->reset('hardwareplacementquote');
        $this->reset('hardwareplacementdevice_disposal');
        $this->reset('hardwareplacementdevice_name');
        $this->reset('hardwareplacementdevice_type');
        $this->reset('hardwareplacementLTstatus');
        $this->reset('hardwareplacementissue');
        $this->reset('hardwareplacementreason');
        $this->reset('hardwareplacementconnection_type');
        $this->reset('hardwareplacementwifi_name');
        $this->reset('hardwareplacementwifi_password');
        $this->reset('hardwareplacementnetwork_type');
        $this->reset('hardwareplacementIP');
        $this->reset('hardwareplacementsubnet');
        $this->reset('hardwareplacementDG');
        $this->reset('hardwareplacementDNS');
        $this->reset('hardwareplacementDNS2');
        $this->reset('hardwareplacementSevenEleven');
        $this->reset('hardwareplacementstore_id');
        $this->reset('hardwareplacementpasscode');
        $this->reset('hardwareplacementapplication');
        $this->reset('hardwareplacementmatrox');
        $this->reset('hardwareplacementsolution_type');
        $this->reset('hardwareplacementorientation');
        $this->reset('hardwareplacementscreen_model');
        $this->reset('hardwareplacementserial_number');
        $this->reset('hardwareplacementend');
        $this->reset('hardwareplacementnetwork_device_type');
        $this->reset('hardwareplacementprojector_model');
        $this->reset('hardwareplacementprojector_lamp');
        $this->reset('hardwareplacementnotes');
        $this->reset('hardwareplacementL2');
        $this->reset('hardwareplacementperson');
        $this->reset('hardwareplacementphone');
        $this->reset('hardwareplacementemail');
        $this->reset('hardwareplacementaddress');

        $this->reset('technicianrequestwarranty');
        $this->reset('technicianrequestquote');
        $this->reset('technicianrequestdevice_disposal');
        $this->reset('technicianrequestdevice_name');
        $this->reset('technicianrequestdevice_type');
        $this->reset('technicianrequestLTstatus');
        $this->reset('technicianrequesttechs_required');
        $this->reset('technicianrequestjob');
        $this->reset('technicianrequestissue');
        $this->reset('technicianrequestL2');
        $this->reset('technicianrequestsupport_types_id');
        $this->reset('technicianrequesttools');
        $this->reset('technicianrequestdisplay_status');
        $this->reset('technicianrequestperson');
        $this->reset('technicianrequestphone');
        $this->reset('technicianrequestemail');
        $this->reset('technicianrequestaddress');

        $this->reset('faultyunitreturnperson');
        $this->reset('faultyunitreturnphone');
        $this->reset('faultyunitreturnemail');
        $this->reset('faultyunitreturnaddress');
        $this->reset('faultyunitreturnnotes');

        $this->reset('warrantyrepairreason');
        $this->reset('warrantyrepairsoftware');
        $this->reset('warrantyrepairfirmware');
        $this->reset('warrantyrepairbrand');
        $this->reset('warrantyrepairmodel');
        $this->reset('warrantyrepairserial');
        $this->reset('warrantyrepairstart');
        $this->reset('warrantyrepairend');
        $this->reset('warrantyrepairperson');
        $this->reset('warrantyrepairphone');
        $this->reset('warrantyrepairemail');
        $this->reset('warrantyrepairaddress');
        $this->reset('warrantyrepairL2');
 
        $this->reset('invoicerequestRFQ');
        $this->reset('invoicerequestquote');

        $this->reset('returnauthorizationname');
        $this->reset('returnauthorizationserial_number');

        $this->reset('sowithtechsupport_types_id');
        $this->reset('sowithtechwarranty');
        $this->reset('sowithtechquote');
        $this->reset('sowithtechdevice_disposal');
        $this->reset('sowithtechdevice_name');
        $this->reset('sowithtechdevice_type');
        $this->reset('sowithtechLTstatus');
        $this->reset('sowithtechissue');
        $this->reset('sowithtechreason');
        $this->reset('sowithtechconnection_type');
        $this->reset('sowithtechwifi_name');
        $this->reset('sowithtechwifi_password');
        $this->reset('sowithtechnetwork_type');
        $this->reset('sowithtechIP');
        $this->reset('sowithtechsubnet');
        $this->reset('sowithtechDG');
        $this->reset('sowithtechDNS');
        $this->reset('sowithtechDNS2');
        $this->reset('sowithtechSevenEleven');
        $this->reset('sowithtechstore_id');
        $this->reset('sowithtechpasscode');
        $this->reset('sowithtechpostcode');
        $this->reset('sowithtechapplication');
        $this->reset('sowithtechmatrox');
        $this->reset('sowithtechsolution_type');
        $this->reset('sowithtechorientation');
        $this->reset('sowithtechscreen_model');
        $this->reset('sowithtechserial_number');
        $this->reset('sowithtechend');
        $this->reset('sowithtechnetwork_device_type');
        $this->reset('sowithtechprojector_model');
        $this->reset('sowithtechprojector_lamp');
        $this->reset('sowithtechnotes');
        $this->reset('sowithtechL2');
        $this->reset('sowithtechperson');
        $this->reset('sowithtechphone');
        $this->reset('sowithtechemail');
        $this->reset('sowithtechaddress');
        
        $this->reset('sowithtechtechs_required');
        $this->reset('sowithtechjob');
        $this->reset('sowithtechtools');
        $this->reset('sowithtechdisplay_status');
    
        $this->confirmAdd = true;
    }

    public function confirmArchive($id)
    {
        $this->Archive = $id;
    }

    public function ArchiveTask(Tasks $id)
    {
        $this->authorize('viewAny', App\Models\User::class); 
        $id->status = 4;
        $id->save();
        $this->Archive = false;
        session()->flash('message', 'Task has been archived');
    }

    public function TaskAdd()
    {

        $validatedData =  $this->validate(
            [
                'casenumber' => ['required'],
                'store' => ['required'],
                'task_id' =>  ['required']
            ]
        );

        $task = new Tasks;
        $task->casenumber = $validatedData['casenumber'];
        $task->store = $validatedData['store'];
        $task->task_types_id = $validatedData['task_id'];
        $task->users_id = auth()->user()->id;

        if ($validatedData['task_id'] == 1) {
            $validatedTask = $this->validate([
                'hardwareplacementsupport_types_id' => 'required',
                'hardwareplacementwarranty' => 'required',
                'hardwareplacementquote' => 'required_if:hardwareplacementwarranty,1',
                'hardwareplacementdevice_disposal' => 'required',
                'hardwareplacementdevice_name' => 'required',
                'hardwareplacementdevice_type' => 'required',
                'hardwareplacementLTstatus' => 'required',
                'hardwareplacementissue' => 'required',
                'hardwareplacementreason' => 'required',
                'hardwareplacementconnection_type' => 'required',
                'hardwareplacementwifi_name' => 'required_if:hardwareplacementconnection_type, 1',
                'hardwareplacementwifi_password' => 'required_if:hardwareplacementconnection_type, 1',
                'hardwareplacementnetwork_type' => 'required',
                'hardwareplacementIP' => 'required_if:hardwareplacementnetwork_type, 1',
                'hardwareplacementsubnet' => 'required_if:hardwareplacementnetwork_type, 1',
                'hardwareplacementDG' => 'required_if:hardwareplacementnetwork_type, 1',
                'hardwareplacementDNS' => 'required_if:hardwareplacementnetwork_type, 1',
                'hardwareplacementDNS2' => 'required_if:hardwareplacementnetwork_type, 1',
                'hardwareplacementSevenEleven' => 'required_if:hardwareplacementdevice_type, 1',
                'hardwareplacementstore_id' => 'required_if:hardwareplacementSevenEleven, 1',
                'hardwareplacementpasscode' => 'required_if:hardwareplacementSevenEleven, 1',
                'hardwareplacementpostcode' => 'required_if:hardwareplacementSevenEleven, 1',
                'hardwareplacementapplication' => 'required',
                'hardwareplacementmatrox' => 'required_if:hardwareplacementapplication, 9',
                'hardwareplacementsolution_type' => 'required',
                'hardwareplacementorientation' => 'required',
                'hardwareplacementscreen_model' => 'required_if:hardwareplacementdevice_type,2',
                'hardwareplacementserial_number' => 'required_if:hardwareplacementdevice_type,2',
                'hardwareplacementend'  => 'required_if:hardwareplacementdevice_type,2',
                'hardwareplacementnetwork_device_type' => 'required_if:hardwareplacementdevice_type,3',
                'hardwareplacementprojector_model' => 'required_if:hardwareplacementdevice_type,4',
                'hardwareplacementprojector_lamp' => 'required_if:hardwareplacementdevice_type,4',
                'hardwareplacementnotes' => 'required',
                'hardwareplacementL2' => 'required',
                'hardwareplacementperson' => 'required',
                'hardwareplacementphone' => 'required',
                'hardwareplacementemail' => 'required|email',
                'hardwareplacementaddress' => 'required',
            ]);
            $task->save();
            $address = new SiteAddress;
            $address->person = $validatedTask['hardwareplacementperson'];
            $address->phone = $validatedTask['hardwareplacementphone'];
            $address->email = $validatedTask['hardwareplacementemail'];
            $address->address = $validatedTask['hardwareplacementaddress'];
            $address->save();

            $hardware = new HardwareReplacement;
            $hardware->tasks_id = $task->id;
            $hardware->support_types_id = $validatedTask['hardwareplacementsupport_types_id'];
            $hardware->warranty = $validatedTask['hardwareplacementwarranty'];
            $hardware->quote = $validatedTask['hardwareplacementquote'];
            $hardware->device_disposal = $validatedTask['hardwareplacementdevice_disposal'];
            $hardware->device_name = $validatedTask['hardwareplacementdevice_name'];
            $hardware->device_type = $validatedTask['hardwareplacementdevice_type'];
            $hardware->LTstatus =  $validatedTask['hardwareplacementLTstatus'];
            $hardware->issue = $validatedTask['hardwareplacementissue'];
            $hardware->reason = $validatedTask['hardwareplacementreason'];
            $hardware->connection_type = $validatedTask['hardwareplacementconnection_type'];
            $hardware->wifi_name = $validatedTask['hardwareplacementwifi_name'];
            $hardware->wifi_password = $validatedTask['hardwareplacementwifi_password'];
            $hardware->network_type = $validatedTask['hardwareplacementnetwork_type'];
            $hardware->IP = $validatedTask['hardwareplacementIP'];
            $hardware->subnet = $validatedTask['hardwareplacementsubnet'];
            $hardware->DG = $validatedTask['hardwareplacementDG'];
            $hardware->DNS = $validatedTask['hardwareplacementDNS'];
            $hardware->DNS2 = $validatedTask['hardwareplacementDNS2'];
            $hardware->SevenEleven = $validatedTask['hardwareplacementSevenEleven'];
            $hardware->store_id = $validatedTask['hardwareplacementstore_id'];
            $hardware->postcode = $validatedTask['hardwareplacementpostcode'];
            $hardware->passcode = $validatedTask['hardwareplacementpasscode'];
            $hardware->application = $validatedTask['hardwareplacementapplication'];
            $hardware->matrox = $validatedTask['hardwareplacementmatrox'];
            $hardware->solution_type = $validatedTask['hardwareplacementsolution_type'];
            $hardware->orientation = $validatedTask['hardwareplacementorientation'];
            $hardware->screen_model = $validatedTask['hardwareplacementscreen_model'];
            $hardware->serial_number = $validatedTask['hardwareplacementserial_number'];
            $hardware->end = $validatedTask['hardwareplacementend'];
            $hardware->network_device_type = $validatedTask['hardwareplacementnetwork_device_type'];
            $hardware->projector_model = $validatedTask['hardwareplacementprojector_model'];
            $hardware->projector_lamp = $validatedTask['hardwareplacementprojector_lamp'];
            $hardware->notes = $validatedTask['hardwareplacementnotes'];
            $hardware->L2 = $validatedTask['hardwareplacementL2'];
            $hardware->Address = $address->id;
            $hardware->save();

            if ($validatedTask['hardwareplacementquote'] != null) {

                $createinvoice = new Tasks;
                $createinvoice->casenumber = $task->casenumber;
                $createinvoice->store = $task->store;
                $createinvoice->task_types_id = 5;
                $createinvoice->users_id = auth()->user()->id;
                $createinvoice->save();

                $invoice = new InvoiceRequest;
                $invoice->tasks_id = $createinvoice->id;
                $invoice->quote = $validatedTask['hardwareplacementquote'];
                $invoice->save();
            }

            if($validatedTask['hardwareplacementwarranty'] == 0 ) {
                $createfaultyunitreturn = new Tasks;
                $createfaultyunitreturn->casenumber = $task->casenumber;
                $createfaultyunitreturn->store = $task->store;
                $createfaultyunitreturn->task_types_id = 3;
                $createfaultyunitreturn->users_id = auth()->user()->id;
                $createfaultyunitreturn->save();

                $faultyunitreturn = new FaultyUnitReturn;
                $faultyunitreturn->tasks_id = $createfaultyunitreturn->id;
                $faultyunitreturn->address = $hardware->Address;
                $faultyunitreturn->save();
            }

            if ($validatedTask['hardwareplacementdevice_disposal'] == 1) {

                $createRA = new Tasks;
                $createRA->casenumber = $task->casenumber;
                $createRA->store = $task->store;
                $createRA->task_types_id = 7;
                $createRA->users_id = auth()->user()->id;
                $createRA->save();

                $RA = new ReturnAuthorization;
                $RA->name = $task->store;
                $RA->serial_number = $validatedTask['hardwareplacementserial_number'];
                $RA->save();
            }
        }

        if ($validatedData['task_id'] == 2) {
            $validatedTask = $this->validate([
             'technicianrequestwarranty' => 'required',
             'technicianrequestquote' => 'required_if:technicianrequestwarranty,1',
             'technicianrequestdevice_disposal' => 'required',
             'technicianrequestdevice_name' => 'required',
             'technicianrequestdevice_type' => 'required',
             'technicianrequestLTstatus' => 'required',
             'technicianrequesttechs_required' => 'required|numeric',
             'technicianrequestjob' => 'required',
             'technicianrequestissue' => 'required',
             'technicianrequestL2' => 'required',
             'technicianrequestsupport_types_id' => 'required',
             'technicianrequesttools' => 'required',
             'technicianrequestdisplay_status' => 'required',
             'technicianrequestperson' => 'required',
             'technicianrequestphone' => 'required',
             'technicianrequestemail' => 'required|email',
             'technicianrequestaddress' => 'required'
            ]);
            $task->save();
            $address = new SiteAddress;
            $address->person = $validatedTask['technicianrequestperson'];
            $address->phone = $validatedTask['technicianrequestphone'];
            $address->email = $validatedTask['technicianrequestemail'];
            $address->address = $validatedTask['technicianrequestaddress'];
            $address->save();

            $technician = new TechnicianRequest;
            $technician->tasks_id = $task->id;
            $technician->support_types_id = $validatedTask['technicianrequestsupport_types_id'];
            $technician->warranty = $validatedTask['technicianrequestwarranty'];
            $technician->quote = $validatedTask['technicianrequestquote'];
            $technician->device_disposal = $validatedTask['technicianrequestdevice_disposal'];
            $technician->device_name = $validatedTask['technicianrequestdevice_name'];
            $technician->device_type = $validatedTask['technicianrequestdevice_type'];
            $technician->display_status = $validatedTask['technicianrequestdisplay_status'];
            $technician->LTstatus = $validatedTask['technicianrequestLTstatus'];
            $technician->techs_required = $validatedTask['technicianrequesttechs_required'];
            $technician->job = $validatedTask['technicianrequestjob'];
            $technician->tools = $validatedTask['technicianrequesttools'];
            $technician->issue = $validatedTask['technicianrequestissue'];
            $technician->Address = $address->id;
            $technician->L2 = $validatedTask['technicianrequestL2'];
            $technician->save();

            if ($validatedTask['technicianrequestquote'] != null) {

                $createinvoice = new Tasks;
                $createinvoice->casenumber = $task->casenumber;
                $createinvoice->store = $task->store;
                $createinvoice->task_types_id = 5;
                $createinvoice->users_id = auth()->user()->id;
                $createinvoice->save();

                $invoice = new InvoiceRequest;
                $invoice->tasks_id = $createinvoice->id;
                $invoice->quote = $validatedTask['technicianrequestquote'];
                $invoice->save();
            }

            if ($validatedTask['technicianrequestdevice_disposal'] == 1) {

                $createRA = new Tasks;
                $createRA->casenumber = $task->casenumber;
                $createRA->store = $task->store;
                $createRA->task_types_id = 7;
                $createRA->users_id = auth()->user()->id;
                $createRA->save();

                $RA = new ReturnAuthorization;
                $RA->name = $task->store;
                $RA->save();
            }
        }

        if ($validatedData['task_id'] == 3) {
            $validatedTask = $this->validate([
                'faultyunitreturnperson' => 'required',
                'faultyunitreturnphone' => 'required',
                'faultyunitreturnemail' => 'required|email',
                'faultyunitreturnaddress' => 'required',
                'faultyunitreturnnotes' => 'required'
            ]);
            $task->save();
            $address = new SiteAddress;
            $address->person = $validatedTask['faultyunitreturnperson'];
            $address->phone = $validatedTask['faultyunitreturnphone'];
            $address->email = $validatedTask['faultyunitreturnemail'];
            $address->address = $validatedTask['faultyunitreturnaddress'];
            $address->save();

            $faultyunitreturn = new FaultyUnitReturn;
            $faultyunitreturn->tasks_id = $task->id;
            $faultyunitreturn->Address= $address->id;
            $faultyunitreturn->notes = $validatedTask['faultyunitreturnnotes'];
            $faultyunitreturn->save();
        }

        if ($validatedData['task_id'] == 4){
            $validatedTask = $this->validate([
                'warrantyrepairreason' => 'required',
                'warrantyrepairsoftware' => 'required',
                'warrantyrepairfirmware' => 'required',
                'warrantyrepairbrand' => 'required',
                'warrantyrepairmodel' => 'required',
                'warrantyrepairserial' => 'required',
                'warrantyrepairstart' => 'required',
                'warrantyrepairend' => 'required',
                'warrantyrepairperson' => 'required',
                'warrantyrepairphone' => 'required',
                'warrantyrepairemail' => 'required|email',
                'warrantyrepairaddress' => 'required',
                'warrantyrepairL2' => 'required'
            ]);
            $task->save();
            $address = new SiteAddress;
            $address->person = $validatedTask['warrantyrepairperson'];
            $address->phone = $validatedTask['warrantyrepairphone'];
            $address->email = $validatedTask['warrantyrepairemail'];
            $address->address = $validatedTask['warrantyrepairaddress'];
            $address->save();

            $warrantyrepair = new WarrantyRepair;
            $warrantyrepair->tasks_id = $task->id;
            $warrantyrepair->reason = $validatedTask['warrantyrepairreason'];
            $warrantyrepair->software =   $validatedTask['warrantyrepairsoftware'];
            $warrantyrepair->firmware = $validatedTask['warrantyrepairfirmware'];
            $warrantyrepair->brand = $validatedTask['warrantyrepairbrand'];
            $warrantyrepair->model = $validatedTask['warrantyrepairmodel'];
            $warrantyrepair->serial = $validatedTask['warrantyrepairserial'];
            $warrantyrepair->start = $validatedTask['warrantyrepairstart'];
            $warrantyrepair->end = $validatedTask['warrantyrepairend'];
            $warrantyrepair->Address = $address->id;
            $warrantyrepair->L2 = $validatedTask['warrantyrepairL2'];
            $warrantyrepair->save();
        }

        if ($validatedData['task_id'] == 5){
            $validatedTask = $this->validate([
                'invoicerequestRFQ' => 'required',
                'invoicerequestquote' => 'required',
            ]);
            $task->save();
            $invoicerequest = new InvoiceRequest;
            $invoicerequest->tasks_id = $task->id;
            $invoicerequest->RFQ = $validatedTask['invoicerequestRFQ'];
            $invoicerequest->quote = $validatedTask['invoicerequestquote'];
            $invoicerequest->save();
        }

        if ($validatedData['task_id'] == 7) {
            $validatedTask = $this->validate([
                'returnauthorizationserial_number' => 'required',
            ]);
            $task->save();
            $returnauthorization = new ReturnAuthorization;
            $returnauthorization->tasks_id = $task->id;
            $returnauthorization->name = $task->store;
            $returnauthorization->serial_number = $validatedTask['returnauthorizationserial_number'];
            $returnauthorization->save();
        }

        if ($validatedData['task_id'] == 6){
            $validatedTask = $this->validate([
                'sowithtechsupport_types_id' => 'required',
                'sowithtechwarranty' => 'required',
                'sowithtechquote' => 'required_if:sowithtechwarranty,1',
                'sowithtechdevice_disposal' => 'required',
                'sowithtechdevice_name' => 'required',
                'sowithtechdevice_type' => 'required',
                'sowithtechLTstatus' => 'required',
                'sowithtechissue' => 'required',
                'sowithtechreason' => 'required',
                'sowithtechconnection_type' => 'required',
                'sowithtechwifi_name' => 'required_if:sowithtechconnection_type, 1',
                'sowithtechwifi_password' => 'required_if:sowithtechconnection_type, 1',
                'sowithtechnetwork_type' => 'required',
                'sowithtechIP' => 'required_if:sowithtechnetwork_type, 1',
                'sowithtechsubnet' => 'required_if:sowithtechnetwork_type, 1',
                'sowithtechDG' => 'required_if:sowithtechnetwork_type, 1',
                'sowithtechDNS' => 'required_if:sowithtechnetwork_type, 1',
                'sowithtechDNS2' => 'required_if:sowithtechnetwork_type, 1',
                'sowithtechSevenEleven' => 'required_if:sowithtechdevice_type, 1',
                'sowithtechstore_id' => 'required_if:sowithtechSevenEleven, 1',
                'sowithtechpasscode' => 'required_if:sowithtechSevenEleven, 1',
                'sowithtechpostcode' => 'required_if:sowithtechSevenEleven, 1',
                'sowithtechapplication' => 'required',
                'sowithtechmatrox' => 'required_if:sowithtechapplication, 9',
                'sowithtechsolution_type' => 'required',
                'sowithtechorientation' => 'required',
                'sowithtechscreen_model' => 'required_if:sowithtechdevice_type,2',
                'sowithtechserial_number' => 'required_if:sowithtechdevice_type,2',
                'sowithtechend'  => 'required_if:sowithtechdevice_type,2',
                'sowithtechnetwork_device_type' => 'required_if:sowithtechdevice_type,3',
                'sowithtechprojector_model' => 'required_if:sowithtechdevice_type,4',
                'sowithtechprojector_lamp' => 'required_if:sowithtechdevice_type,4',
                'sowithtechnotes' => 'required',
                'sowithtechL2' => 'required',
                'sowithtechperson' => 'required',
                'sowithtechphone' => 'required',
                'sowithtechemail' => 'required|email',
                'sowithtechaddress' => 'required',
                'sowithtechtechs_required' => 'required',
                'sowithtechjob' => 'required',
                'sowithtechtools' => 'required',
                'sowithtechdisplay_status' => 'required',
            ]);
            $task->save();
            $address = new SiteAddress;
            $address->person = $validatedTask['sowithtechperson'];
            $address->phone = $validatedTask['sowithtechphone'];
            $address->email = $validatedTask['sowithtechemail'];
            $address->address = $validatedTask['sowithtechaddress'];
            $address->save();

            $sowithtech = new SOwithTech;
            $sowithtech->tasks_id = $task->id;
            $sowithtech->support_types_id = $validatedTask['sowithtechsupport_types_id'];
            $sowithtech->warranty = $validatedTask['sowithtechwarranty'];
            $sowithtech->quote = $validatedTask['sowithtechquote'];
            $sowithtech->device_disposal = $validatedTask['sowithtechdevice_disposal'];
            $sowithtech->device_name = $validatedTask['sowithtechdevice_name'];
            $sowithtech->device_type = $validatedTask['sowithtechdevice_type'];
            $sowithtech->LTstatus =  $validatedTask['sowithtechLTstatus'];
            $sowithtech->issue = $validatedTask['sowithtechissue'];
            $sowithtech->reason = $validatedTask['sowithtechreason'];
            $sowithtech->connection_type = $validatedTask['sowithtechconnection_type'];
            $sowithtech->wifi_name = $validatedTask['sowithtechwifi_name'];
            $sowithtech->wifi_password = $validatedTask['sowithtechwifi_password'];
            $sowithtech->network_type = $validatedTask['sowithtechnetwork_type'];
            $sowithtech->IP = $validatedTask['sowithtechIP'];
            $sowithtech->subnet = $validatedTask['sowithtechsubnet'];
            $sowithtech->DG = $validatedTask['sowithtechDG'];
            $sowithtech->DNS = $validatedTask['sowithtechDNS'];
            $sowithtech->DNS2 = $validatedTask['sowithtechDNS2'];
            $sowithtech->SevenEleven = $validatedTask['sowithtechSevenEleven'];
            $sowithtech->store_id = $validatedTask['sowithtechstore_id'];
            $sowithtech->postcode = $validatedTask['sowithtechpostcode'];
            $sowithtech->passcode = $validatedTask['sowithtechpasscode'];
            $sowithtech->application = $validatedTask['sowithtechapplication'];
            $sowithtech->matrox = $validatedTask['sowithtechmatrox'];
            $sowithtech->solution_type = $validatedTask['sowithtechsolution_type'];
            $sowithtech->orientation = $validatedTask['sowithtechorientation'];
            $sowithtech->screen_model = $validatedTask['sowithtechscreen_model'];
            $sowithtech->serial_number = $validatedTask['sowithtechserial_number'];
            $sowithtech->end = $validatedTask['sowithtechend'];
            $sowithtech->network_device_type = $validatedTask['sowithtechnetwork_device_type'];
            $sowithtech->projector_model = $validatedTask['sowithtechprojector_model'];
            $sowithtech->projector_lamp = $validatedTask['sowithtechprojector_lamp'];
            $sowithtech->notes = $validatedTask['sowithtechnotes'];
            $sowithtech->L2 = $validatedTask['sowithtechL2'];
            $sowithtech->Address = $address->id;
            $sowithtech->techs_required = $validatedTask['sowithtechtechs_required'];
            $sowithtech->job = $validatedTask['sowithtechjob'];
            $sowithtech->tools = $validatedTask['sowithtechtools'];
            $sowithtech->display_status =$validatedTask['sowithtechdisplay_status'];
            $sowithtech->save();

            if ($validatedTask['sowithtechquote'] != null) {

                $createinvoice = new Tasks;
                $createinvoice->casenumber = $task->casenumber;
                $createinvoice->store = $task->store;
                $createinvoice->task_types_id = 5;
                $createinvoice->users_id = auth()->user()->id;
                $createinvoice->save();

                $invoice = new InvoiceRequest;
                $invoice->tasks_id = $createinvoice->id;
                $invoice->quote = $validatedTask['sowithtechquote'];
                $invoice->save();
            }

            if($validatedTask['sowithtechwarranty'] == 0 ) {
                $createfaultyunitreturn = new Tasks;
                $createfaultyunitreturn->casenumber = $task->casenumber;
                $createfaultyunitreturn->store = $task->store;
                $createfaultyunitreturn->task_types_id = 3;
                $createfaultyunitreturn->users_id = auth()->user()->id;
                $createfaultyunitreturn->save();

                $faultyunitreturn = new FaultyUnitReturn;
                $faultyunitreturn->tasks_id = $createfaultyunitreturn->id;
                $faultyunitreturn->address = $hardware->Address;
                $faultyunitreturn->save();
            }

            if ($validatedTask['sowithtechdevice_disposal'] == 1) {

                $createRA = new Tasks;
                $createRA->casenumber = $task->casenumber;
                $createRA->store = $task->store;
                $createRA->task_types_id = 7;
                $createRA->users_id = auth()->user()->id;
                $createRA->save();

                $RA = new ReturnAuthorization;
                $RA->name = $task->store;
                $RA->serial_number = $validatedTask['sowithtechserial_number'];
                $RA->save();
            }

        }

        $this->confirmAdd = false;
        $this->reset('store');
        $this->reset('task_id');
        $this->reset('casenumber');

        session()->flash('message', 'Task has been added');
    }
}
