<div>
    <div class="flex flex-col max-w-full overflow-x-hidden shadow-md m-8">

        @if(session()->has('message'))
        <div class="fixed top-0 right-0 bg-opacity-0 ">
            <div class="text-right py-4 lg:px-4 rounded animate-fade-in-down" wire:poll.5000ms>
                <div class="p-2 bg-green-500 items-center bg-opacity-75 text-green-100 leading-none rounded-full lg:rounded-full flex lg:inline-flex" role="alert">
                    <span class="flex rounded-full bg-green-200 uppercase px-2 py-1 text-xs font-bold mr-3">
                        <svg class="h-8 w-8 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M468.907 214.604c-11.423 0-20.682 9.26-20.682 20.682v20.831c-.031 54.338-21.221 105.412-59.666 143.812-38.417 38.372-89.467 59.5-143.761 59.5h-.12C132.506 459.365 41.3 368.056 41.364 255.883c.031-54.337 21.221-105.411 59.667-143.813 38.417-38.372 89.468-59.5 143.761-59.5h.12c28.672.016 56.49 5.942 82.68 17.611 10.436 4.65 22.659-.041 27.309-10.474 4.648-10.433-.04-22.659-10.474-27.309-31.516-14.043-64.989-21.173-99.492-21.192h-.144c-65.329 0-126.767 25.428-172.993 71.6C25.536 129.014.038 190.473 0 255.861c-.037 65.386 25.389 126.874 71.599 173.136 46.21 46.262 107.668 71.76 173.055 71.798h.144c65.329 0 126.767-25.427 172.993-71.6 46.262-46.209 71.76-107.668 71.798-173.066v-20.842c0-11.423-9.259-20.683-20.682-20.683z" />
                            <path d="M505.942 39.803c-8.077-8.076-21.172-8.076-29.249 0L244.794 271.701l-52.609-52.609c-8.076-8.077-21.172-8.077-29.248 0-8.077 8.077-8.077 21.172 0 29.249l67.234 67.234a20.616 20.616 0 0 0 14.625 6.058 20.618 20.618 0 0 0 14.625-6.058L505.942 69.052c8.077-8.077 8.077-21.172 0-29.249z" />
                        </svg>
                    </span>
                    <span class="font-semibold mr-2 text-left flex-auto"> {{ session('message') }} </span>
                </div>
            </div>
        </div>
        @endif
        <!-- Tools -->
        <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 bg-white p-6 space-y-2 md:space-y-0">
            <div class="relative sm:col-span-2 md:col-span-3 lg:col-span-2">
                <input wire:model.debounce.500ms="q" type="text" placeholder="Search case ....." class="block w-full px-8 py-2 border border-gray-300 placeholder-gray-500 text-gray-800 shadow-sm rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 focus:z-10 sm:text-sm" />

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="absolute left-3 bottom-3 h-4 w-4 text-gray-500">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <div class="">
                <select name="task_types_id	" wire:model="task_types_id" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-800 shadow-sm rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 focus:z-10 sm:text-sm">
                    <option value="">Select Task Type</option>
                    @foreach($tasktypes as $task)
                    <option value="{{$task->id}}"> {{$task->name}}

                    </option>
                    @endforeach
                </select>



            </div>

            <div class="">
                <select name="status" wire:model="status" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-800 shadow-sm rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 focus:z-10 sm:text-sm">
                    <option value="">Status </option>
                    <option value="0">Pending</option>
                    <option value="1">Grabbed</option>
                    <option value="2">Completed</option>
                </select>
            </div>


            <button class="bg-indigo-800 text-white text-xs font-semibold py-2 rounded-md border-0" wire:click="confirmingAdd" wire:loading.attr="disabled">Create a Task</button>

        </div>

        <!--Add Task Modal -->
        <x-jet-dialog-modal wire:model="confirmAdd">
            <x-slot name="title">
                {{ __('Add a Task') }}

            </x-slot>

            <x-slot name="content">
                <div class="flex flex-wrap gap-1 py-1 mb-2">
                    <div class="px-2 w-1/5">
                        <x-jet-label for="case" value="{{ __('Case Number') }}" />
                        <x-jet-input id="case" class="block mt-1 w-full" type="text" name="case" required wire:model.defer="case" />
                        <x-jet-input-error for="case" class="mt-2" />
                    </div>

                    <div class="px-2 w-1/3">
                        <x-jet-label for="store" value="{{ __('Store Location') }}" />
                        <x-jet-input id="store" class="block mt-1 w-full" type="text" name="store" required wire:model.defer="store" />
                        <x-jet-input-error for="store" class="mt-2" />
                    </div>

                    <div class="px-2 w-2/6">

                        <x-jet-label for="task_id" value="{{ __('Task Type') }}" />
                        <select id="task_id" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="task_id" required wire:model.defer="task_id" />
                        <option value=""> Select a Task </option>

                        @foreach($tasktypes as $task)
                        <option value="{{$task->id}}"> {{$task->name}}</option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="task_id" class="mt-2" />
                    </div>
                    <!-- Hardware Request Form -->
                    <div x-data="{ HRModal: @entangle('HRModal') }">

                        <div x-show="HRModal">
                            <div class="flex flex-wrap gap-1 py-1">
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRwarranty" value="{{ __('Device Warranty?') }}" />
                                    <select id="HRwarranty" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="HRwarranty" required wire:model="HRwarranty" />
                                    <option value="1" selected> Yes </option>
                                    <option value="0"> No </option>

                                    </select>
                                    <x-jet-input-error for="HRwarranty" class="mt-2" />
                                </div>
                                @if($HRwarranty === "0")
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRquote" value="{{ __('Quote Number') }}" />
                                    <x-jet-input id="HRquote" class="block mt-1 w-auto" type="text" name="HRquote" required wire:model="HRquote" />
                                    <x-jet-input-error for="HRquote" class="mt-2" />
                                </div>
                                @endif

                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRdevice_disposal" value="{{ __('Device Disposal') }}" />
                                    <select id="HRdevice_disposal" class="mt-1 w-auto border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="HRdevice_disposal" required wire:model="HRdevice_disposal" />
                                    <option value=""> Select.. </option>
                                    <option value="0"> Store </option>
                                    <option value="1"> Engagis </option>
                                    <option value="2"> N/A </option>
                                    </select>
                                    <x-jet-input-error for="HRdevice_disposal" class="mt-2" />
                                </div>

                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRdevice_name" value="{{ __('Device Name') }}" />
                                    <x-jet-input id="HRdevice_name" class="block mt-1 w-auto" type="text" name="HRdevice_name" required wire:model="HRdevice_name" />
                                    <x-jet-input-error for="HRdevice_name" class="mt-2" />
                                </div>

                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRdevice_type" value="{{ __('Device Type') }}" />
                                    <select id="HRdevice_type" class="mt-1 w-auto border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="HRdevice_type" required wire:model="HRdevice_type" />
                                    <option value=""> Select.. </option>
                                    @foreach($devicetypes as $type)
                                    <option value="{{$type->id}}"> {{$type->name}} </option>
                                    @endforeach
                                    </select>
                                    <x-jet-input-error for="HRdevice_type" class="mt-2" />
                                </div>

                                @if($HRdevice_type == 1)
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HR7Eleven" value="{{ __('7-Eleven MP?') }}" />
                                    <select id="HR7Eleven" class="mt-1 w-auto border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="HR7Eleven" required wire:model="HR7Eleven" />
                                    <option value=""> Select.. </option>
                                    <option value="0"> No </option>
                                    <option value="1"> Yes </option>
                                    </select>
                                    <x-jet-input-error for="HR7Eleven" class="mt-2" />
                                </div>
                                @endif

                                @if($HR7Eleven == 1 && $HRdevice_type == 1)
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRstore_id" value="{{ __('Store ID') }}" />
                                    <x-jet-input id="HRstore_id" class="block mt-1 w-auto" type="text" name="HRstore_id" required wire:model="HRstore_id" />
                                    <x-jet-input-error for="HRstore_id" class="mt-2" />
                                </div>

                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRpostcode" value="{{ __('POST CODE') }}" />
                                    <x-jet-input id="HRpostcode" class="block mt-1 w-auto" type="text" name="HRpostcode" required wire:model="HRpostcode" />
                                    <x-jet-input-error for="HRpostcode" class="mt-2" />
                                </div>

                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRpasscode" value="{{ __('PASS CODE') }}" />
                                    <x-jet-input id="HRpasscode" class="block mt-1 w-auto" type="text" name="HRpasscode" required wire:model="HRpasscode" />
                                    <x-jet-input-error for="HRpasscode" class="mt-2" />
                                </div>
                                @endif

                                @if($HRdevice_type == 2)
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRscreen_model" value="{{ __('Screen Model') }}" />
                                    <x-jet-input id="HRscreen_model" class="block mt-1 w-auto" type="text" name="HRscreen_model" required wire:model="HRscreen_model" />
                                    <x-jet-input-error for="HRscreen_model" class="mt-2" />
                                </div>
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRserial_number" value="{{ __('Serial Number') }}" />
                                    <x-jet-input id="HRserial_number" class="block mt-1 w-auto" type="text" name="HRserial_number" required wire:model="HRserial_number" />
                                    <x-jet-input-error for="HRserial_number" class="mt-2" />
                                </div>
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRend" value="{{ __('Warranty End Date') }}" />
                                    <x-jet-input id="HRend" class="block mt-1 w-auto" type="date" name="HRend" required wire:model="HRend" />
                                    <x-jet-input-error for="HRend" class="mt-2" />
                                </div>
                                @endif     

                                @if($HRdevice_type == 3)
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRnetwork_device_type" value="{{ __('Network Device') }}" />
                                    <select id="HRnetwork_device_type" class="mt-1 w-auto border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="HRnetwork_device_type" required wire:model="HRnetwork_device_type" />
                                    <option value=""> Select.. </option>
                                    <option value="0"> Router </option>
                                    <option value="1"> Switch </option>
                                    <option value="2"> Others </option>
                                    </select>
                                    <x-jet-input-error for="HRnetwork_device_type" class="mt-2" />
                                </div>
                                @endif    

                                @if($HRdevice_type == 4)
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRprojector_model" value="{{ __('Projector') }}" />
                                    <x-jet-input id="HRprojector_model" class="block mt-1 w-auto" type="text" name="HRprojector_model" required wire:model="HRprojector_model" />
                                    <x-jet-input-error for="HRprojector_model" class="mt-2" />
                                </div>
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRprojector_lamp" value="{{ __('Projector Lamp') }}" />
                                    <x-jet-input id="HRprojector_lamp" class="block mt-1 w-auto" type="text" name="HRprojector_lamp" required wire:model="HRprojector_lamp" />
                                    <x-jet-input-error for="HRprojector_lamp" class="mt-2" />
                                </div>
                                @endif   

                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRLTstatus" value="{{ __('Labtech Status') }}" />
                                    <select id="HRLTstatus" class="mt-1 w-auto border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="HRLTstatus" required wire:model="HRLTstatus" />
                                    <option value=""> Select.. </option>
                                    <option value="0"> Offline </option>
                                    <option value="1"> Online </option>
                                    </select>
                                    <x-jet-input-error for="HRLTstatus" class="mt-2" />
                                </div>  

                                <div class="px-2 w-full">
                                    <x-jet-label for="HRissue" value="{{ __('Issue Reported') }}" />
                                    <x-jet-input id="HRissue" class="block mt-1 w-auto" type="text" name="HRissue" required wire:model="HRissue" />
                                    <x-jet-input-error for="HRissue" class="mt-2" />
                                </div>    

                                <div class="px-2 w-full">
                                <x-jet-label for="HRreason" value="{{ __('Replacement Reason') }}" />
                                    <select id="HRreason" class="mt-1 w-auto border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="HRreason" required wire:model="HRreason" />
                                    <option value=""> Select.. </option>
                                    @foreach($replacementreasons as $id)
                                    <option value="{{$id->id}}"> {{$id->name}} </option>
                                    @endforeach
                                    </select>
                                    <x-jet-input-error for="HRreason" class="mt-2" />
                                </div>  

                               <div class="px-2 w-auto">
                                    <x-jet-label for="HRconnection_type" value="{{ __('Connection Type') }}" />
                                    <select id="HRconnection_type" class="mt-1 w-auto border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="HRconnection_type" required wire:model="HRconnection_type" />
                                    <option value=""> Select.. </option>
                                    <option value="0"> Wired </option>
                                    <option value="1"> Wireless </option>
                                    </select>
                                    <x-jet-input-error for="HRconnection_type" class="mt-2" />
                                </div>   

                                @if($HRconnection_type == 1) 
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRwifi_name" value="{{ __('Wifi Name') }}" />
                                    <x-jet-input id="HRwifi_name" class="block mt-1 w-auto" type="text" name="HRwifi_name" required wire:model="HRwifi_name" />
                                    <x-jet-input-error for="HRwifi_name" class="mt-2" />
                                </div>   
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRwifi_password" value="{{ __('Wifi Password') }}" />
                                    <x-jet-input id="HRwifi_password" class="block mt-1 w-auto" type="text" name="HRwifi_password" required wire:model="HRwifi_password" />
                                    <x-jet-input-error for="HRwifi_password" class="mt-2" />
                                </div>                                  
                                @endif    

                                @if($HRdevice_type == 1)
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRnetwork_type" value="{{ __('Network Type') }}" />
                                    <select id="HRnetwork_type" class="mt-1 w-auto border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="HRnetwork_type" required wire:model="HRnetwork_type" />
                                    <option value=""> Select.. </option>
                                    <option value="0"> DHCP IP </option>
                                    <option value="1"> Static IP </option>
                                    </select>
                                    <x-jet-input-error for="HRnetwork_type" class="mt-2" />
                                </div>   
                                @endif   

                                @if($HRnetwork_type == 1)    
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRIP" value="{{ __('IP Address') }}" />
                                    <x-jet-input id="HRIP" class="block mt-1 w-auto" type="text" name="HRIP" required wire:model="HRIP" />
                                    <x-jet-input-error for="HRIP" class="mt-2" />
                                </div> 
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRsubnet" value="{{ __('Subnet Mask') }}" />
                                    <x-jet-input id="HRsubnet" class="block mt-1 w-auto" type="text" name="HRsubnet" required wire:model="HRsubnet" />
                                    <x-jet-input-error for="HRsubnet" class="mt-2" />
                                </div>      
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRDG" value="{{ __('Default Gateway') }}" />
                                    <x-jet-input id="HRDG" class="block mt-1 w-auto" type="text" name="HRDG" required wire:model="HRDG" />
                                    <x-jet-input-error for="HRDG" class="mt-2" />
                                </div>     
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRDNS" value="{{ __('DNS1') }}" />
                                    <x-jet-input id="HRDNS" class="block mt-1 w-auto" type="text" name="HRDNS" required wire:model="HRDNS" />
                                    <x-jet-input-error for="HRDNS" class="mt-2" />
                                </div>   
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRDNS2" value="{{ __('DNS2') }}" />
                                    <x-jet-input id="HRDNS2" class="block mt-1 w-auto" type="text" name="HRDNS2" required wire:model="HRDNS2" />
                                    <x-jet-input-error for="HRDNS2" class="mt-2" />
                                </div>                                                                                                                           
                                @endif 

                               <div class="px-2 w-auto">
                                    <x-jet-label for="HRapplication" value="{{ __('Application') }}" />
                                    <select id="HRapplication" class="mt-1 w-auto border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="HRapplication" required wire:model="HRapplication" />
                                    <option value=""> Select.. </option>
                                    @foreach($applications as $application)
                                    <option value="{{$application->id}}"> {{$application->name}} </option>
                                    @endforeach
                                    </select>
                                    <x-jet-input-error for="HRapplication" class="mt-2" />
                                </div>       

                                @if($HRapplication == 9)
                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRmatrox" value="{{ __('Include Matrox?') }}" />
                                    <select id="HRmatrox" class="mt-1 w-auto border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="HRmatrox" required wire:model="HRmatrox" />
                                    <option value=""> Select.. </option>
                                    <option value="0"> No </option>
                                    <option value="1"> Yes </option>
                                    </select>
                                    <x-jet-input-error for="HRmatrox" class="mt-2" />
                                </div>
                                @endif    

                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRsolution_type" value="{{ __('Solution Type') }}" />
                                    <select id="HRsolution_type" class="mt-1 w-auto border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="HRsolution_type" required wire:model="HRsolution_type" />
                                    <option value=""> Select.. </option>
                                    @foreach($solutiontypes as $application)
                                    <option value="{{$application->id}}"> {{$application->name}} </option>
                                    @endforeach
                                    </select>
                                    <x-jet-input-error for="HRsolution_type" class="mt-2" />
                                </div>   

                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRorientation" value="{{ __('Orientation') }}" />
                                    <select id="HRorientation" class="mt-1 w-auto border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="HRorientation" required wire:model="HRorientation" />
                                    <option value=""> Select.. </option>
                                    <option value="0"> Portrait </option>
                                    <option value="1"> Landscape </option>
                                    </select>
                                    <x-jet-input-error for="HRorientation" class="mt-2" />
                                </div>  

                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRperson" value="{{ __('Contact Person') }}" />
                                    <x-jet-input id="HRperson" class="block mt-1 w-auto" type="text" name="HRperson" required wire:model="HRperson" />
                                    <x-jet-input-error for="HRperson" class="mt-2" />
                                </div>   

                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRphone" value="{{ __('Contact Number') }}" />
                                    <x-jet-input id="HRphone" class="block mt-1 w-auto" type="text" name="HRphone" required wire:model="HRphone" />
                                    <x-jet-input-error for="HRphone" class="mt-2" />
                                </div>   

                                <div class="px-2 w-auto">
                                    <x-jet-label for="HRemail" value="{{ __('Contact Email') }}" />
                                    <x-jet-input id="HRemail" class="block mt-1 w-auto" type="email" name="HRemail" required wire:model="HRemail" />
                                    <x-jet-input-error for="HRemail" class="mt-2" />
                                </div>  

                                <div class="px-2 w-full">
                                    <x-jet-label for="HRaddress" value="{{ __('Address') }}" />
                                    <x-jet-input id="HRaddress" class="block mt-1 w-full" type="text" name="HRaddress" required wire:model="HRaddress" />
                                    <x-jet-input-error for="HRaddress" class="mt-2" />
                                </div>   

                               <div class="px-2 w-auto">
                                    <x-jet-label for="HRL2" value="{{ __('L2 Approver') }}" />
                                    <select id="HRL2" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="HRL2" required wire:model.defer="HRL2" />
                                    <option value="Dinesh Lama"> Dinesh Lama </option>
                                    <option value="Emee Casas"> Emee Casas </option>
                                    <option value="Keziah Cababaros"> Keziah Cababaros</option>
                                    <option value="Melvin Dacut"> Melvin Dacut </option>
                                    <option value="Naila Casino"> Naila Casino </option>
                                    <option value="Samir Bastola "> Samir Bastola </option>
                                    <option value="Wendell Segundo"> Wendell Segundo </option>
                                    </select>
                                    <x-jet-input-error for="HRL2" class="mt-2" />
                                </div>       

                                 <div class="px-2 w-auto">
                                        <x-jet-label for="HRnotes" value="{{ __('Additional Notes') }}" />
                                        <textarea rows="5" cols="42" id="HRnotes" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text" name="HRnotes" required wire:model.defer="HRnotes" /> </textarea>
                                        <x-jet-input-error for="HRnotes" class="mt-2" />
                                </div>                                                                                                                                                                                                                                                                           

                            </div>     
                        </div>
                    </div>

                        <div class="w-full py-1" x-data="{ invoicerequest: @entangle('invoicerequest') }">

                            <div class="flex py-1 " x-show="invoicerequest">
                                <div class="px-2 w-auto">
                                    <x-jet-label for="RFQ" value="{{ __('Have you advised RFQ that quote is won?') }}" />
                                    <select id="RFQ" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="RFQ" required wire:model="RFQ" />
                                    <option value=""> Select.. </option>
                                    <option value="0"> No </option>
                                    <option value="1"> Yes </option>
                                    </select>
                                    <x-jet-input-error for="RFQ" class="mt-2" />
                                </div>

                                <div class="px-2 w-auto">
                                    <x-jet-label for="quote" value="{{ __('Quote Number') }}" />
                                    <x-jet-input id="quote" class="block mt-1 w-full" type="text" name="store" required wire:model="quote" />
                                    <x-jet-input-error for="quote" class="mt-2" />
                                </div>
                            </div>

                        </div>

                        <div class="w-full py-1" x-data="{ warrantyrepair: @entangle('warrantyrepair') }">

                            <div class="flex flex-wrap py-1" x-show="warrantyrepair">

                                <div class="px-2 w-auto">
                                    <x-jet-label for="reason" value="{{ __('Warranty Repair Reason') }}" />
                                    <x-jet-input id="reason" class="block mt-1" type="text" name="reason" required wire:model.defer="reason" />
                                    <x-jet-input-error for="reason" class="mt-2" />
                                </div>

                                <div class="px-2 w-auto">
                                    <x-jet-label for="software" value="{{ __('Software Version') }}" />
                                    <x-jet-input id="software" class="block mt-1 w-auto" type="text" name="software" required wire:model.defer="software" />
                                    <x-jet-input-error for="software" class="mt-2" />
                                </div>

                                <div class="px-2 w-auto">
                                    <x-jet-label for="firmware" value="{{ __('Firmware Version') }}" />
                                    <x-jet-input id="firmware" class="block mt-1 w-full" type="text" name="firmware" required wire:model.defer="firmware" />
                                    <x-jet-input-error for="firmware" class="mt-2" />
                                </div>

                                <div class="px-2 w-auto">
                                    <x-jet-label for="brand" value="{{ __('Brand') }}" />
                                    <x-jet-input id="brand" class="block mt-1 w-full" type="text" name="brand" required wire:model.defer="brand" />
                                    <x-jet-input-error for="brand" class="mt-2" />
                                </div>

                                <div class="px-2 w-auto">
                                    <x-jet-label for="model" value="{{ __('Model') }}" />
                                    <x-jet-input id="model" class="block mt-1 w-full" type="text" name="model" required wire:model.defer="model" />
                                    <x-jet-input-error for="model" class="mt-2" />
                                </div>

                                <div class="px-2 w-auto">
                                    <x-jet-label for="serial" value="{{ __('Serial Number') }}" />
                                    <x-jet-input id="serial" class="block mt-1 w-full" type="text" name="serial" required wire:model.defer="serial" />
                                    <x-jet-input-error for="serial" class="mt-2" />
                                </div>

                                <div class="px-2 w-auto">
                                    <x-jet-label for="start" value="{{ __('Warranty Start') }}" />
                                    <x-jet-input id="start" class="block mt-1 w-full" type="date" name="start" required wire:model.defer="start" />
                                    <x-jet-input-error for="start" class="mt-2" />
                                </div>

                                <div class="px-2 w-auto">
                                    <x-jet-label for="end" value="{{ __('Warranty End') }}" />
                                    <x-jet-input id="end" class="block mt-1 w-full" type="date" name="end" required wire:model.defer="end" />
                                    <x-jet-input-error for="end" class="mt-2" />
                                </div>

                                <div class="px-2 w-auto">
                                    <x-jet-label for="L2" value="{{ __('L2 Approver') }}" />
                                    <select id="L2" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="L2" required wire:model.defer="L2" />
                                    <option value="Dinesh Lama"> Dinesh Lama </option>
                                    <option value="Emee Casas"> Emee Casas </option>
                                    <option value="Keziah Cababaros"> Keziah Cababaros</option>
                                    <option value="Melvin Dacut"> Melvin Dacut </option>
                                    <option value="Naila Casino"> Naila Casino </option>
                                    <option value="Samir Bastola "> Samir Bastola </option>
                                    <option value="Wendell Segundo"> Wendell Segundo </option>
                                    </select>
                                    <x-jet-input-error for="L2" class="mt-2" />
                                </div>


                            </div>

                        </div>

                        <div class="w-full py-1" x-data="{ TR: @entangle('TR') }">

                            <div x-show="TR">
                                <div class="flex py-1">
                                    <div class="px-2 w-auto">
                                        <x-jet-label for="device_disposal" value="{{ __('Device Disposal?') }}" />
                                        <select id="device_disposal" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="device_disposal" required wire:model="device_disposal" />
                                        <option value=""> Select.. </option>
                                        <option value="0"> Store </option>
                                        <option value="1"> Engagis </option>
                                        <option value="2"> N/A </option>
                                        </select>
                                        <x-jet-input-error for="device_disposal" class="mt-2" />
                                    </div>

                                    <div class="px-2 w-auto">
                                        <x-jet-label for="device_name" value="{{ __('Device Name') }}" />
                                        <x-jet-input id="device_name" class="block mt-1 w-full" type="text" name="device_name" required wire:model.defer="device_name" />
                                        <x-jet-input-error for="device_name" class="mt-2" />
                                    </div>

                                    <div class="px-2 w-auto">
                                        <x-jet-label for="LTstatus" value="{{ __('LT Status') }}" />
                                        <select id="LTstatus" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="LTstatus" required wire:model="LTstatus" />
                                        <option value=""> Select.. </option>
                                        <option value="0"> Offline </option>
                                        <option value="1"> Online </option>
                                        <option value="2"> N/A </option>
                                        </select>
                                        <x-jet-input-error for="LTstatus" class="mt-2" />
                                    </div>

                                    <div class="px-2 w-1/4" x-show="techs_required">
                                        <x-jet-label for="techs_required" value="{{ __('Techs Required') }}" />
                                        <x-jet-input id="techs_required" class="block mt-1 w-full" type="text" name="techs_required" required wire:model.defer="techs_required" />
                                        <x-jet-input-error for="techs_required" class="mt-2" />

                                    </div>

                                </div>

                                <div x-data="{ TRWarranty: @entangle('TRWarranty') }">
                                    <div class="flex py-1">
                                        <div class="px-2 w-full flex-auto">
                                            <x-jet-label for="issue" value="{{ __('Issue Reported') }}" />
                                            <x-jet-input id="issue" class="block mt-1 w-full" type="text" name="issue" required wire:model.defer="issue" />
                                            <x-jet-input-error for="issue" class="mt-2" />
                                        </div>

                                        <div class="px-2 w-full flex-auto">
                                            <x-jet-label for="warranty" value="{{ __('Covered by Warranty?') }}" />
                                            <select id="warranty" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="warranty" required wire:model="warranty" />
                                            <option value=""> Select.. </option>
                                            <option value="0"> No </option>
                                            <option value="1"> Yes </option>
                                            <option value="2"> N/A </option>
                                            </select>
                                            <x-jet-input-error for="warranty" class="mt-2" />
                                        </div>


                                        <div class="px-2 w-full flex-auto" x-show="TRWarranty">
                                            <x-jet-label for="quoteTR" value="{{ __('Quote') }}" />
                                            <x-jet-input id="quoteTR" class="block mt-1 w-full" type="text" name="quoteTR" required wire:model.defer="quoteTR" />
                                            <x-jet-input-error for="quoteTR" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="px-2 w-full flex-auto">
                                        <x-jet-label for="job" value="{{ __('Additional Notes') }}" />
                                        <textarea rows="5" cols="42" id="job" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text" name="notes" required wire:model.defer="job" /> </textarea>
                                        <x-jet-input-error for="job" class="mt-2" />
                                    </div>

                                    <div class="px-2 w-auto flex-auto">
                                        <x-jet-label for="personTR" value="{{ __('Contact Person') }}" />
                                        <x-jet-input id="personTR" class="block mt-1 w-full" type="text" name="personTR" required wire:model.defer="personTR" />
                                        <x-jet-input-error for="personTR" class="mt-2" />
                                    </div>

                                    <div class="px-2 w-auto flex-auto">
                                        <x-jet-label for="phoneTR" value="{{ __('Contact Number') }}" />
                                        <x-jet-input id="phoneTR" class="block mt-1 w-full" type="text" name="phoneTR" required wire:model.defer="phoneTR" />
                                        <x-jet-input-error for="phoneTR" class="mt-2" />
                                    </div>

                                    <div class="px-2 w-auto flex-auto">
                                        <x-jet-label for="emailTR" value="{{ __('Email Address') }}" />
                                        <x-jet-input id="emailTR" class="block mt-1 w-full" type="email" name="emailTR" required wire:model.defer="emailTR" />
                                        <x-jet-input-error for="emailTR" class="mt-2" />
                                    </div>

                                    <div class="px-2 w-full">
                                        <x-jet-label for="addressTR" value="{{ __('Site Address') }}" />
                                        <x-jet-input id="addressTR" class="block mt-1 w-full" type="text" name="addressTR" required wire:model.defer="addressTR" />
                                        <x-jet-input-error for="addressTR" class="mt-2" />
                                    </div>

                                    <div class="px-2 w-auto">
                                    <x-jet-label for="TRL2" value="{{ __('L2 Approver') }}" />
                                    <select id="TRL2" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="TRL2" required wire:model.defer="TRL2" />
                                    <option value="Dinesh Lama"> Dinesh Lama </option>
                                    <option value="Emee Casas"> Emee Casas </option>
                                    <option value="Keziah Cababaros"> Keziah Cababaros</option>
                                    <option value="Melvin Dacut"> Melvin Dacut </option>
                                    <option value="Naila Casino"> Naila Casino </option>
                                    <option value="Samir Bastola "> Samir Bastola </option>
                                    <option value="Wendell Segundo"> Wendell Segundo </option>
                                    </select>
                                    <x-jet-input-error for="TRL2" class="mt-2" />
                                 </div>


                                </div>

                            </div>
                        </div>

                        <div class="w-full py-1" x-data="{ site: @entangle('site') }">

                            <div class="flex flex-wrap py-1" x-show="site">

                                <div class="px-2 w-1/3">
                                    <x-jet-label for="person" value="{{ __('Contact Person') }}" />
                                    <x-jet-input id="person" class="block mt-1 w-full" type="text" name="person" required wire:model.defer="person" />
                                    <x-jet-input-error for="person" class="mt-2" />
                                </div>

                                <div class="px-2 w-1/3">
                                    <x-jet-label for="phone" value="{{ __('Contact Number') }}" />
                                    <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" required wire:model.defer="phone" />
                                    <x-jet-input-error for="phone" class="mt-2" />
                                </div>

                                <div class="px-2 w-1/3">
                                    <x-jet-label for="email" value="{{ __('Email Address') }}" />
                                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" required wire:model.defer="email" />
                                    <x-jet-input-error for="email" class="mt-2" />
                                </div>

                                <div class="px-2 w-full">
                                    <x-jet-label for="address" value="{{ __('Site Address') }}" />
                                    <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" required wire:model.defer="address" />
                                    <x-jet-input-error for="address" class="mt-2" />
                                </div>

                            </div>

                        </div>

                        <div class="w-full py-1" x-data="{ unitreturn: @entangle('unitreturn') }">

                            <div class="flex flex-wrap py-1" x-show="unitreturn" @click.away="unitreturn = false">

                                <div class="px-2 w-full">
                                    <x-jet-label for="notes" value="{{ __('Additional Notes') }}" />
                                    <textarea rows="5" cols="8" id="notes" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text" name="notes" required wire:model.defer="notes" /> </textarea>
                                    <x-jet-input-error for="notes" class="mt-2" />
                                </div>

                            </div>

                        </div>


                    </div>
            </x-slot>

            <x-slot name="footer">

                <x-jet-button class="ml-2" wire:click="AddTask()" wire:loading.attr="disabled">
                    {{ __('Add Task') }}
                </x-jet-button>
                <x-jet-secondary-button wire:click="$set('confirmAdd', false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

            </x-slot>
        </x-jet-dialog-modal>

        <!-- End Tools -->

        <table class="overflow-x-auto w-full bg-white">
            <thead class="bg-blue-100 border-b border-gray-300">
                <tr>
                    <th class="p-4 text-left text-sm font-bold text-gray-500">Date</th>
                    <th class="p-4 text-left text-sm font-bold text-gray-500">Case</th>
                    <th class="p-4 text-left text-sm font-bold text-gray-500">Client</th>
                    <th class="p-4 text-left text-sm font-bold text-gray-500">Task Type</th>
                    <th class="p-4 text-left text-sm font-bold text-gray-500">Owner</th>
                    <th class="p-4 text-left text-sm font-bold text-gray-500">Admin</th>
                    <th class="p-4 text-left text-sm font-bold text-gray-500">Status</th>
                    <th class="p-4 text-left text-sm font-bold text-gray-500">Action</th>
                    <th class="p-4 text-left text-sm font-bold text-gray-500"></th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm divide-y divide-gray-300">
                <tr class="bg-white font-medium text-sm divide-y divide-gray-200">
                    @foreach($tasks as $task)
                    <td class="p-4 whitespace-nowrap"> {{$task->created_at }}</td>
                    <td class="p-4 whitespace-nowrap">{{$task->case }}</td>
                    <td class="p-4 whitespace-nowrap">{{$task->store }}</td>
                    <td class="p-4 whitespace-nowrap">{{$task->TaskType->name }}</td>
                    <td class="p-4 whitespace-nowrap">{{$task->user->name }}</td>
                    <td class="p-4 whitespace-nowrap"> @isset($task->Admin ) {{$task->Admin->name}} @endisset </td>
                    <td class="p-4 whitespace-nowrap">

                        @if($task->status == 0)
                        <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4"> Pending </span>
                        @endif

                        @if($task->status == 1)
                        <span class="bg-green-100 text-green-600 text-xs font-semibold rounded-2xl py-1 px-4"> Assigned </span>
                        @endif

                        @if($task->status == 2)
                        <span class="bg-blue-100 text-blue-600 text-xs font-semibold rounded-2xl py-1 px-4"> Completed </span>
                        @endif
                    </td>

                    <td class="p-4 whitespace-nowrap">
                        <div class="flex space-x-1">
                            <button class="border-2 border-indigo-200 rounded-md p-1" wire:click="confirmView({{$task->id}})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-indigo-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>

                            <!-- View Task Modal -->
                            <x-jet-dialog-modal wire:model="View">
                                <x-slot name="title">
                                    {{ __('View Task') }}
                                    <hr>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="flex flex-wrap justify-between">

                                        <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500"> Case: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$viewCase}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> Store: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$viewStore}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> Status: </dt>
                                            @if ($viewStatus == 0)
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                                                <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                                    {{$viewStatus == 0 ? 'Pending' : '' }} </span>
                                            </dd>
                                            @endif

                                            @if ($viewStatus == 1)
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                                                <span class="bg-green-100 text-green-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                                    {{$viewStatus == 1 ? 'Assigned' : '' }} </span>
                                            </dd>
                                            @endif

                                            @if ($viewStatus == 2)
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                                                <span class="bg-blue-100 text-blue-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                                    {{$viewStatus == 2 ? 'Completed' : '' }} </span>
                                            </dd>
                                            @endif

                                        </div>
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500"> Task Type: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$viewTask }}</dd>
                                            <dt class="text-sm font-medium text-gray-500"> Owner: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$viewUser}}</dd>
                                            <dt class="text-sm font-medium text-gray-500"> Assigned: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">

                                                @if ($viewAdmin !== null)
                                                <span class="bg-indigo-100 text-indigo-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                                    {{$viewAdmin}}</span>
                                            </dd>
                                            @endif


                                            @if ($viewAdmin == null)
                                            <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                                {{$viewAdmin}}</span> </dd>
                                            @endif

                                        </div>
                                    </div>

                                    <hr class="mt-2 mb-2">

                                    @if ($TRView != null)

                                    <div class="flex flex-wrap justify-between">
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500"> Issue Reported: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$TRIssue}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> Device Name: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$TRDevice_Name}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> LT Status: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">

                                                @if($TRLTStatus == 0)
                                                <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4"> Offline </span>
                                                @endif

                                                @if($TRLTStatus == 1)
                                                <span class="bg-green-100 text-green-600 text-xs font-semibold rounded-2xl py-1 px-4"> Online </span>
                                                @endif

                                                @if($TRLTStatus == 2)
                                                <span class="bg-blue-100 text-blue-600 text-xs font-semibold rounded-2xl py-1 px-4"> N/A </span>
                                                @endif
                                            </dd>

                                            <dt class="text-sm font-medium text-gray-500"> Contact: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$TRPerson}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> Phone: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$TRPhone}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> Email: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$TREmail}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> Address: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$TRAddress}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> L2 Approver: </dt> 
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$TRL2}} </dd>
                                        </div>

                                        <div class="sm:grid sm:grid-cols-3 mt-2 sm:gap-2 sm:px-6">

                                            @if($TRWarrantyView == 0)
                                            <dt class="text-sm font-medium text-gray-500"> Warranty</dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                                                <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                                    No </span>
                                            </dd>
                                            <dt class="text-sm font-medium text-gray-500"> Quote</dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$TRQuote}} </dd>
                                            @endif

                                            @if($TRDevice_Disposal != 2)
                                            <dt class="text-sm font-medium text-gray-500"> Device Disposal</dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">

                                                @if($TRDevice_Disposal == 0)
                                                <span class="bg-blue-100 text-blue-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                                    Store </span> @endif

                                                @if($TRDevice_Disposal == 1)
                                                <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                                    Engagis </span> @endif

                                            </dd>
                                            @endif

                                            <dt class="text-sm font-medium text-gray-500"> Techs Required </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$TRTechs_Required}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> Job Required </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$TRJob}} </dd>
                                        </div>
                                    </div>

                                    @endif

                                    @if($HRView != null)

                                    <div class="flex flex-wrap justify-between">
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            @if($HRwarranty == 0)
                                            <dt class="text-sm font-medium text-gray-500"> Device in Warranty: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> 
                                            <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4"> {{$HRquote}} </span>  </dd>
                                            @endif
                                      
                                            @if($HRdevice_disposal == 0)
                                            <dt class="text-sm font-medium text-gray-500"> Device Disposal: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                                            <span class="bg-blue-100 text-blue-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                             Store </dd>
                                            @endif

                                            @if($HRdevice_disposal == 1)
                                            <dt class="text-sm font-medium text-gray-500"> Device Disposal: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                                            <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                             Engagis </dd>
                                            @endif

                                            <dt class="text-sm font-medium text-gray-500"> Device Name: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRdevice_name}} </dd>
                                        
                                            <dt class="text-sm font-medium text-gray-500"> Device Type: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRdevice_type}} </dd>

                                            @if($HR7Eleven == 1)
                                            <dt class="text-sm font-medium text-gray-500"> 7-Eleven Player: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> Yes </dd>

                                            <dt class="text-sm font-medium text-gray-500"> Store ID: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRstore_id}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> POSTCODE: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRpostcode}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> PASSCODE: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRpasscode}} </dd>                                     
                                            @endif

                                            @if($HRLTstatus != 2)
                                            <dt class="text-sm font-medium text-gray-500"> LT Status: </dt>                  
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">   {{$HRLTstatus == 0 ? 'Offline' : 'Online'}}  </dd>
                                            @endif
                                           
                                            <dt class="text-sm font-medium text-gray-500"> Issue Reported: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRissue}} </dd>
                                            
                                            <dt class="text-sm font-medium text-gray-500"> Replacement Reason: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRreason}} </dd>
                                            
                                            <dt class="text-sm font-medium text-gray-500"> Connection Type: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRconnection_type == 0 ? 'Wired' : 'Wireless'}} </dd>

                                            @if($HRconnection_type == 1)
                                            <dt class="text-sm font-medium text-gray-500"> Wifi Name: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRwifi_name}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> Wifi Password: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRwifi_password}} </dd>
                                            @endif

                                            <dt class="text-sm font-medium text-gray-500"> Network Type: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRnetwork_type == 0 ? 'DHCP': 'Static' }} </dd>

                                            @if($HRnetwork_type == 1)
                                            <dt class="text-sm font-medium text-gray-500"> IP Address: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRIP}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> Subnet Mask: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRsubnet}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> Default Gateway: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRDG}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> DNS 1: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRDNS}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> DNS 2:  </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRDNS2}} </dd>
                                            @endif

                                            <dt class="text-sm font-medium text-gray-500"> Application: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRapplication}} </dd>

                                            @if($HRmatrox == 1)
                                            <dt class="text-sm font-medium text-gray-500"> Include Matrox? </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">  <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">Yes </span></dd>
                                            @endif

                                            <dt class="text-sm font-medium text-gray-500"> Solution Type: </dt>                          
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRsolution_type}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> Orientation: </dt> 
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRorientation == 0 ? 'Landscape' : 'Portrait'}} </dd>
                                            
                                            @if($HRdevice_type == 2)
                                            <dt class="text-sm font-medium text-gray-500"> Screen Model: </dt> 
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{HRscreen_model}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> Serial Number: </dt> 
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{HRserial_number}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> Warranty End Date: </dt> 
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{HRend}} </dd>
                                            @endif

                                            @if($HRdevice_type == 3)
                                            <dt class="text-sm font-medium text-gray-500"> Network Device Type: </dt> 
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRnetwork_device_type}} </dd>
                                            @endif

                                            @if($HRdevice_type == 4)
                                            <dt class="text-sm font-medium text-gray-500"> Projector Model: </dt> 
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$projector_model}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> Projector Lamp: </dt> 
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$projector_lamp}} </dd>
                                            @endif

                                            <dt class="text-sm font-medium text-gray-500"> Notes: </dt> 
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRnotes}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> L2 Approver: </dt> 
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRL2}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> Site Contact: </dt> 
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRperson}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> Phone: </dt> 
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRphone}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> Email </dt> 
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRemail}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> Address </dt> 
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$HRaddress}} </dd>
                                        </div>
                                    </div>
                                     @endif

                                    @if ($FUR != null)
                                    <div class="flex flex-wrap justify-between">
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500"> Contact Person: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$FURPerson}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> Phone: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$FURPhone}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> Email: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$FUREmail}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> Address: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$FURAddressComplete}} </dd>

                                            <dt class="text-sm font-medium text-gray-500"> Notes: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$FURNotes}} </dd>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($IR != null)
                                    <div class="flex flex-wrap justify-between">
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500"> Quote: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$IRQuote}} </dd>
                                            <dt class="text-sm font-medium text-gray-500 w-full"> Advised RFQ Quote is WON?: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                                                @if($IRRFQ == 0)
                                                <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                                    Not Yet </span>
                                                @endif
                                                @if($IRRFQ == 1)
                                                <span class="bg-green-100 text-green-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                                    Yes </span>
                                                @endif
                                            </dd>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($WR != null)
                                    <div class="flex flex-wrap justify-between">
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6 w-full">
                                            <dt class="text-sm font-medium text-gray-500"> Reason for Repair: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$WRReason}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> Software Version: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$WRSoftware}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> Firmware Version: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$WRFirmware}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> Brand: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$WRBrand}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> Model: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$WRModel}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> Serial Number: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$WRSerial}} </dd>
                                        </div>
                                        <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6 w-full mt-2">

                                            <dt class="text-sm font-medium text-gray-500"> Warranty Start: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$WRStart}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> Warranty End: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$WREnd}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> Contact Person: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$WRPerson}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> Phone: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$WRPhone}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> Email: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$WREmail}} </dd>
                                            <dt class="text-sm font-medium text-gray-500"> L2 Approver: </dt>
                                            <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                                                <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                                    {{$WRL2}} </span>
                                            </dd>
                                        </div>
                                    </div>
                                    @endif


                                </x-slot>

                                <x-slot name="footer">
                                    <x-jet-secondary-button wire:click="$set('View', false,)" wire:loading.attr="disabled">
                                        {{ __('Close') }}
                                    </x-jet-secondary-button>
                                </x-slot>
                            </x-jet-dialog-modal>



                            <!-- Delete Task Confirmation Modal -->
                            <x-jet-confirmation-modal wire:model="Delete">
                                <x-slot name="title">
                                    {{ __('Delete Task') }}
                                </x-slot>

                                <x-slot name="content">
                                    {{ __('Are you sure you want to delete this task?') }}
                                </x-slot>

                                <x-slot name="footer">
                                    <x-jet-danger-button class="ml-2" wire:click="DeleteTask( {{$Delete}})" wire:loading.attr="disabled">
                                        {{ __('Remove') }}
                                    </x-jet-danger-button>
                                    <x-jet-secondary-button wire:click="$set('Delete', false)" wire:loading.attr="disabled">
                                        {{ __('Cancel') }}
                                    </x-jet-secondary-button>
                                </x-slot>
                            </x-jet-confirmation-modal>
                            @can('viewAny', App\Models\User::class)
                            <button class="border-2 border-red-200 rounded-md p-1" wire:click="confirmDelete({{$task->id}})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                            @endcan
                        </div>
                    </td>
                    <td class="p-4 whitespace-nowrap">

                        <!-- Grab Task Confirmation Modal -->
                        <x-jet-confirmation-modal wire:model="confirmGrab">
                            <x-slot name="title">
                                {{ __('Grab Task') }}
                            </x-slot>

                            <x-slot name="content">
                                {{ __('Are you sure you want to grab this task?') }}
                            </x-slot>

                            <x-slot name="footer">
                                <x-jet-danger-button class="ml-2" wire:click="Grab( {{$confirmGrab}})" wire:loading.attr="disabled">
                                    {{ __('Grab') }}
                                </x-jet-danger-button>
                                <x-jet-secondary-button wire:click="$set('confirmGrab', false)" wire:loading.attr="disabled">
                                    {{ __('Cancel') }}
                                </x-jet-secondary-button>
                            </x-slot>
                        </x-jet-confirmation-modal>

                        <!-- Mark as Completed Task Confirmation Modal -->
                        <x-jet-confirmation-modal wire:model="confirmDone">
                            <x-slot name="title">
                                {{ __('Completed Task') }}
                            </x-slot>

                            <x-slot name="content">
                                {{ __('Confirming you have completed the task') }}
                            </x-slot>

                            <x-slot name="footer">
                                <x-jet-danger-button class="ml-2" wire:click="Done( {{$confirmDone}})" wire:loading.attr="disabled">
                                    {{ __('Confirm') }}
                                </x-jet-danger-button>
                                <x-jet-secondary-button wire:click="$set('confirmDone', false)" wire:loading.attr="disabled">
                                    {{ __('Cancel') }}
                                </x-jet-secondary-button>
                            </x-slot>
                        </x-jet-confirmation-modal>

                        @can('viewAny', App\Models\User::class)
                        @if ($task->admin == null)
                        <button class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-4 py-2 rounded-md border-0" wire:click="confirmingGrab( {{$task->id }})" wire:loading.attr="disabled">Grab</button>
                        @endif
                        @if ($task->admin != null && $task->status == 1)
                        <button class="bg-green-100 text-green-800 text-xs font-semibold px-4 py-2 rounded-md border-0" wire:click="confirmingDone( {{$task->id }})" wire:loading.attr="disabled">Close</button>
                        @endif
                        @endcan

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4" data-turbolinks="false">
            {{ $tasks->links() }}
        </div>

    </div>

</div>