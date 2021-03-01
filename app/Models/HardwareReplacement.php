<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HardwareReplacement extends Model
{
    use HasFactory;

    protected $fillable = [

        'tasks_id',
        'warranty',
        'quote',
        'device_disposal',
        'device_name',       
        'device_type',   
        'LTstatus',    
        'issue',          
        'reason',  
        'connection_type',  
        'wifi_name',   
            'wifi_password',        
            'network_type',
            'IP',
            'subnet',
            'DG',
            'DNS',
            'DNS2',
            'SevenEleven',
            'store_id',
            'postcode',         
            'passcode',
            'application',
            'matrox',
            'solution_type',
            'orientation',
            'screen_model',
            'serial_number',
            'end',
            'network_device_type',
            'projector_model',
            'projector_lamp',
            'notes',
            'Address',
            'L2',
    ];
}
