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
            <div class="">
                <input wire:model.debounce.500ms="q" type="text" placeholder="Search case ....." class="block w-full px-8 py-2 border border-gray-300 placeholder-gray-500 text-gray-800 shadow-sm rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 focus:z-10 sm:text-sm" />


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
                <select name="owners" wire:model="owners" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-800 shadow-sm rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 focus:z-10 sm:text-sm">
                    <option value="">Select Owner</option>

                    @foreach($owner as $owners)
                    <option value="{{$owners->RoleUser->first()->users_id}}"> {{$owners->name}}
                    </option>
                    @endforeach

                </select>
            </div>

            <div class="">
                <select name="admins" wire:model="admins" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-800 shadow-sm rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 focus:z-10 sm:text-sm">
                    <option value="">Select Admin</option>
                    @isset($admin)
                    @foreach($admin as $admins)
                    <option value="{{$admins->RoleUser->first()->users_id}}"> {{$admins->name}}
                    </option>
                    @endforeach
                    @endisset
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
        <!-- End Tools -->

        <!-- Start Table -->

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
                    <td class="p-4 whitespace-nowrap">
                        <div class="flex space-x-1">
                            {{$task->casenumber }}

                            @foreach ($task->identifyDuplicate() as $id => $value)
                            @if($value == $task->casenumber)
                            <div title="Existing case available">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-indigo-500 ml-1" title="Existing case available">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            @break
                            @endif
                            @endforeach
                        </div>

                    </td>
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
                            <button class="border-2 border-indigo-200 rounded-md p-1" wire:click="confirmView({{$task->id}})" title="View Task">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-indigo-500" title="View Task">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>

                            @can('viewAny', App\Models\User::class)
                            <button class="border-2 border-red-200 rounded-md p-1" wire:click="confirmArchive({{$task->id}})" title="Archive Task">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-red-500" title="Archive Task">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                            @endcan
                        </div>
                    </td>

                    <td class="p-4 whitespace-nowrap">

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


        <!--Add Task Modal -->
        <x-jet-dialog-modal wire:model="confirmAdd">
            <x-slot name="title">
                {{ __('Add User') }}
            </x-slot>

            <x-slot name="content">
                <hr>
                <div class="flex flex-wrap gap-1 py-1 mb-2">
                    <div class="px-2 w-auto">
                        <x-jet-label for="case" value="{{ __('Case Number') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="casenumber" />
                        <x-jet-input-error for="casenumber" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="store" value="{{ __('Store Location') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="store" />
                        <x-jet-input-error for="store" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">

                        <x-jet-label for="task_id" value="{{ __('Task Type') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="task_id" />
                        <option value=""> Select a Task </option>

                        @foreach($tasktypes as $task)
                        <option value="{{$task->id}}"> {{$task->name}}</option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="task_id" class="mt-2" />
                    </div>
                </div>

                @if($task_id == "1")
                <div class="mb-1">
                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementsupport_types_id" value="{{ __('Support Type') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="hardwareplacementsupport_types_id" />
                        <option value=""> Select </option>

                        @foreach($supporttypes as $type)
                        <option value="{{$type->id}}"> {{$type->name}}</option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="hardwareplacementsupport_types_id" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementwarranty" value="{{ __('Warranty Status') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="hardwareplacementwarranty" />
                        <option value=""> Select </option>
                        <option value="0"> Yes </option>
                        <option value="1"> No </option>
                        </select>
                        <x-jet-input-error for="hardwareplacementwarranty" class="mt-2" />
                    </div>

                    @if($hardwareplacementwarranty == "1")
                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementquote" value="{{ __('Quote') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="hardwareplacementquote" />
                        <x-jet-input-error for="hardwareplacementquote" class="mt-2" />
                    </div>
                    @endif

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementdevice_disposal" value="{{ __('Hardware Disposal Status') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="hardwareplacementdevice_disposal" />
                        <option value=""> Select </option>
                        <option value="0"> Store </option>
                        <option value="1"> Engagis </option>
                        <option value="2"> N/A </option>
                        </select>
                        <x-jet-input-error for="hardwareplacementdevice_disposal" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementdevice_name" value="{{ __('Device Name') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="hardwareplacementdevice_name" />
                        <x-jet-input-error for="hardwareplacementdevice_name" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementdevice_type" value="{{ __('Device Type') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="hardwareplacementdevice_type" />
                        <option value=""> Select </option>

                        @foreach($devicetypes as $type)
                        <option value="{{$type->id}}"> {{$type->name}}</option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="hardwareplacementdevice_type" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementLTstatus" value="{{ __('Labtech Status') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="hardwareplacementLTstatus" />
                        <option value=""> Select </option>
                        <option value="0"> Online </option>
                        <option value="1"> Offline </option>
                        <option value="2"> N/A </option>
                        </select>
                        <x-jet-input-error for="hardwareplacementLTstatus" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementissue" value="{{ __('Issue Reported') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="hardwareplacementissue" />
                        <x-jet-input-error for="hardwareplacementissue" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementreason" value="{{ __('Replacement Reason') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="hardwareplacementreason" />
                        <option value=""> Select </option>
                        @foreach($replacementreasons as $reason)
                        <option value="{{$reason->id}}"> {{$reason->name}} </option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="hardwareplacementreason" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementconnection_type" value="{{ __('Connection Type') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="hardwareplacementconnection_type" />
                        <option value=""> Select </option>
                        <option value="0"> Wired </option>
                        <option value="1"> Wireless </option>
                        </select>
                        <x-jet-input-error for="hardwareplacementconnection_type" class="mt-2" />
                    </div>

                    @if($hardwareplacementconnection_type == "1")
                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementwifi_name" value="{{ __('Wifi Name') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="hardwareplacementwifi_name" />
                        <x-jet-input-error for="hardwareplacementwifi_name" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementwifi_password" value="{{ __('Wifi Password') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="hardwareplacementwifi_password" />
                        <x-jet-input-error for="hardwareplacementwifi_password" class="mt-2" />
                    </div>
                    @endif

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementnetwork_type" value="{{ __('Connection Type') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="hardwareplacementnetwork_type" />
                        <option value=""> Select </option>
                        <option value="0"> DHCP </option>
                        <option value="1"> Static </option>
                        </select>
                        <x-jet-input-error for="hardwareplacementnetwork_type" class="mt-2" />
                    </div>

                    @if($hardwareplacementnetwork_type == "1")
                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementIP" value="{{ __('IP Address') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="hardwareplacementIP" />
                        <x-jet-input-error for="hardwareplacementIP" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementsubnet" value="{{ __('Subnet Mask') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="hardwareplacementsubnet" />
                        <x-jet-input-error for="hardwareplacementsubnet" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementDG" value="{{ __('Default GateWay') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="hardwareplacementDG" />
                        <x-jet-input-error for="hardwareplacementDG" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementDNS" value="{{ __('DNS') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="hardwareplacementDNS" />
                        <x-jet-input-error for="hardwareplacementDNS" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementDNS2" value="{{ __('DNS2') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="hardwareplacementDNS2" />
                        <x-jet-input-error for="hardwareplacementDNS2" class="mt-2" />
                    </div>
                    @endif


                    @if($hardwareplacementdevice_type == "1")
                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementSevenEleven" value="{{ __('7-Evelen Player') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="hardwareplacementSevenEleven" />
                        <option value=""> Select </option>
                        <option value="0"> No </option>
                        <option value="1"> Yes </option>
                        </select>
                        <x-jet-input-error for="hardwareplacementSevenEleven" class="mt-2" />
                    </div>

                    @if($hardwareplacementSevenEleven == "1")
                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementstore_id" value="{{ __('Store ID') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model="hardwareplacementstore_id" />
                        <x-jet-input-error for="hardwareplacementstore_id" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementpostcode" value="{{ __('Post Code') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model="hardwareplacementpostcode" />
                        <x-jet-input-error for="hardwareplacementpostcode" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementpasscode" value="{{ __('Pass Code') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model="hardwareplacementpasscode" />
                        <x-jet-input-error for="hardwareplacementpasscode" class="mt-2" />
                    </div>
                    @endif

                    @endif

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementapplication" value="{{ __('Application') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="hardwareplacementapplication" />
                        <option value=""> Select </option>
                        @foreach($applications as $reason)
                        <option value="{{$reason->id}}"> {{$reason->name}} </option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="hardwareplacementapplication" class="mt-2" />
                    </div>

                    @if($hardwareplacementapplication == "9")
                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementmatrox" value="{{ __('7-Evelen Player') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="hardwareplacementmatrox" />
                        <option value=""> Select </option>
                        <option value="0"> No </option>
                        <option value="1"> Yes </option>
                        </select>
                        <x-jet-input-error for="hardwareplacementmatrox" class="mt-2" />
                    </div>
                    @endif

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementsolution_type" value="{{ __('Solution Type') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="hardwareplacementsolution_type" />
                        <option value=""> Select </option>
                        @foreach($solutiontypes as $reason)
                        <option value="{{$reason->id}}"> {{$reason->name}} </option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="hardwareplacementsolution_type" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementorientation" value="{{ __('Orientation') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="hardwareplacementorientation" />
                        <option value=""> Select </option>
                        <option value="0"> Portrait </option>
                        <option value="1"> Landscape </option>
                        </select>
                        <x-jet-input-error for="hardwareplacementorientation" class="mt-2" />
                    </div>

                    @if($hardwareplacementdevice_type == "2")
                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementserial_number" value="{{ __('Serial Number') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="hardwareplacementserial_number" />
                        <x-jet-input-error for="hardwareplacementserial_number" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementscreen_model" value="{{ __('Screen Model') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="hardwareplacementscreen_model" />
                        <x-jet-input-error for="hardwareplacementscreen_model" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementend" value="{{ __('Warranty End') }}" />
                        <x-jet-input class="block mt-1 w-full" type="date" required wire:model.defer="hardwareplacementend" />
                        <x-jet-input-error for="hardwareplacementend" class="mt-2" />
                    </div>
                    @endif

                    @if($hardwareplacementdevice_type == "3")
                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementnetwork_device_type" value="{{ __('Network Device Type') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="hardwareplacementnetwork_device_type" />
                        <option value=""> Select </option>
                        <option value="0"> Router </option>
                        <option value="1"> Switch </option>
                        </select>
                        <x-jet-input-error for="hardwareplacementnetwork_device_type" class="mt-2" />
                    </div>
                    @endif

                    @if($hardwareplacementdevice_type == "4")
                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementprojector_model" value="{{ __('Projector Model') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="hardwareplacementprojector_model" />
                        <x-jet-input-error for="hardwareplacementprojector_model" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementprojector_lamp" value="{{ __('Projector Lamp') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="hardwareplacementprojector_lamp" />
                        <x-jet-input-error for="hardwareplacementprojector_lamp" class="mt-2" />
                    </div>
                    @endif

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementnotes" value="{{ __('Additional Notes') }}" />
                        <textarea rows="5" cols="42" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text" required wire:model.defer="hardwareplacementnotes" /> </textarea>
                        <x-jet-input-error for="hardwareplacementnotes" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementL2" value="{{ __('L2 Approver') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="hardwareplacementL2" />
                        <option value=""> Select </option>
                        @foreach ($L2 as $id)
                        <option value="{{$id->id}}"> {{$id->name}} </option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="hardwareplacementL2" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementperson" value="{{ __('Contact Person') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="hardwareplacementperson" />
                        <x-jet-input-error for="hardwareplacementperson" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementphone" value="{{ __('Contact Number') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="hardwareplacementphone" />
                        <x-jet-input-error for="hardwareplacementphone" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementemail" value="{{ __('Contact Email') }}" />
                        <x-jet-input class="block mt-1 w-full" type="email" required wire:model.defer="hardwareplacementemail" />
                        <x-jet-input-error for="hardwareplacementemail" class="mt-2" />
                    </div>


                    <div class="px-2 w-auto">
                        <x-jet-label for="hardwareplacementaddress" value="{{ __('Delivery Address') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="hardwareplacementaddress" />
                        <x-jet-input-error for="hardwareplacementaddress" class="mt-2" />
                    </div>

                </div>
                @endif

                @if($task_id == "2")
                <div class="mb-1">
                    <div class="px-2 w-auto">
                        <x-jet-label for="technicianrequestsupport_types_id" value="{{ __('Support Type') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="technicianrequestsupport_types_id" />
                        <option value=""> Select </option>

                        @foreach($supporttypes as $type)
                        <option value="{{$type->id}}"> {{$type->name}}</option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="technicianrequestsupport_types_id" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="technicianrequestwarranty" value="{{ __('Warranty Status') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="technicianrequestwarranty" />
                        <option value=""> Select </option>
                        <option value="0"> Yes </option>
                        <option value="1"> No </option>
                        </select>
                        <x-jet-input-error for="technicianrequestwarranty" class="mt-2" />
                    </div>

                    @if($technicianrequestwarranty == "1")
                    <div class="px-2 w-auto">
                        <x-jet-label for="technicianrequestquote" value="{{ __('Quote') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="technicianrequestquote" />
                        <x-jet-input-error for="technicianrequestquote" class="mt-2" />
                    </div>
                    @endif

                    <div class="px-2 w-auto">
                        <x-jet-label for="technicianrequestdevice_disposal" value="{{ __('Hardware Disposal Status') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="technicianrequestdevice_disposal" />
                        <option value=""> Select </option>
                        <option value="0"> Store </option>
                        <option value="1"> Engagis </option>
                        <option value="2"> N/A </option>
                        </select>
                        <x-jet-input-error for="technicianrequestdevice_disposal" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="technicianrequestdevice_name" value="{{ __('Device Name') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="technicianrequestdevice_name" />
                        <x-jet-input-error for="technicianrequestdevice_name" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="technicianrequestdevice_type" value="{{ __('Device Type') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="technicianrequestdevice_type" />
                        <option value=""> Select </option>

                        @foreach($devicetypes as $type)
                        <option value="{{$type->id}}"> {{$type->name}}</option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="technicianrequestdevice_type" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="technicianrequestdisplay_status" value="{{ __('Display Status') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="technicianrequestdisplay_status" />
                        <option value=""> Select </option>
                        <option value="0"> Displaying </option>
                        <option value="1"> None </option>
                        <option value="2"> N/A </option>
                        </select>
                        <x-jet-input-error for="technicianrequestdisplay_status" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="technicianrequestLTstatus" value="{{ __('Labtech Status') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="technicianrequestLTstatus" />
                        <option value=""> Select </option>
                        <option value="0"> Online </option>
                        <option value="1"> Offline </option>
                        <option value="2"> N/A </option>
                        </select>
                        <x-jet-input-error for="technicianrequestLTstatus" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="technicianrequesttechs_required" value="{{ __('No. of Technicians Required') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="technicianrequesttechs_required" />
                        <x-jet-input-error for="technicianrequesttechs_required" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="technicianrequestjob" value="{{ __('Job Required') }}" />
                        <textarea rows="5" cols="42" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text" required wire:model.defer="technicianrequestjob" /> </textarea>
                        <x-jet-input-error for="technicianrequestjob" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="technicianrequesttools" value="{{ __('Tools Needed') }}" />
                        <textarea rows="5" cols="42" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text" required wire:model.defer="technicianrequesttools" /> </textarea>
                        <x-jet-input-error for="technicianrequesttools" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="technicianrequestissue" value="{{ __('Issue Reported') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="technicianrequestissue" />
                        <x-jet-input-error for="technicianrequestissue" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="technicianrequestL2" value="{{ __('L2 Approver') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="technicianrequestL2" />
                        <option value=""> Select </option>
                        @foreach ($L2 as $id)
                        <option value="{{$id->id}}"> {{$id->name}} </option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="technicianrequestL2" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="technicianrequestperson" value="{{ __('Contact Person') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="technicianrequestperson" />
                        <x-jet-input-error for="technicianrequestperson" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="technicianrequestphone" value="{{ __('Contact Number') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="technicianrequestphone" />
                        <x-jet-input-error for="technicianrequestphone" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="technicianrequestemail" value="{{ __('Contact Email') }}" />
                        <x-jet-input class="block mt-1 w-full" type="email" required wire:model.defer="technicianrequestemail" />
                        <x-jet-input-error for="technicianrequestemail" class="mt-2" />
                    </div>


                    <div class="px-2 w-auto">
                        <x-jet-label for="technicianrequestaddress" value="{{ __('Delivery Address') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="technicianrequestaddress" />
                        <x-jet-input-error for="technicianrequestaddress" class="mt-2" />
                    </div>

                </div>
                @endif

                @if($task_id == "3")
                <div class="mb-1">
                    <div class="px-2 w-auto">
                        <x-jet-label for="faultyunitreturnperson" value="{{ __('Contact Person') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="faultyunitreturnperson" />
                        <x-jet-input-error for="faultyunitreturnperson" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="faultyunitreturnphone" value="{{ __('Contact Number') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="faultyunitreturnphone" />
                        <x-jet-input-error for="faultyunitreturnphone" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="faultyunitreturnemail" value="{{ __('Contact Email') }}" />
                        <x-jet-input class="block mt-1 w-full" type="email" required wire:model.defer="faultyunitreturnemail" />
                        <x-jet-input-error for="faultyunitreturnemail" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="faultyunitreturnaddress" value="{{ __('Delivery Address') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="faultyunitreturnaddress" />
                        <x-jet-input-error for="faultyunitreturnaddress" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="faultyunitreturnnotes" value="{{ __('Additional Notes') }}" />
                        <textarea rows="5" cols="42" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text" required wire:model.defer="faultyunitreturnnotes" /> </textarea>
                        <x-jet-input-error for="faultyunitreturnnotes" class="mt-2" />
                    </div>
                </div>

                @endif

                @if($task_id == "4")
                <div class="mb-1">
                    <div class="px-2 w-auto">
                        <x-jet-label for="warrantyrepairreason" value="{{ __('Reason for Repair') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="warrantyrepairreason" />
                        <x-jet-input-error for="warrantyrepairreason" class="mt-2" />
                    </div>
                    <div class="px-2 w-auto">
                        <x-jet-label for="warrantyrepairsoftware" value="{{ __('Software Version') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="warrantyrepairsoftware" />
                        <x-jet-input-error for="warrantyrepairsoftware" class="mt-2" />
                    </div>
                    <div class="px-2 w-auto">
                        <x-jet-label for="warrantyrepairfirmware" value="{{ __('Firmware Version') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="warrantyrepairfirmware" />
                        <x-jet-input-error for="warrantyrepairfirmware" class="mt-2" />
                    </div>
                    <div class="px-2 w-auto">
                        <x-jet-label for="warrantyrepairbrand" value="{{ __('Brand') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="warrantyrepairbrand" />
                        <x-jet-input-error for="warrantyrepairbrand" class="mt-2" />
                    </div>
                    <div class="px-2 w-auto">
                        <x-jet-label for="warrantyrepairmodel" value="{{ __('Model') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="warrantyrepairmodel" />
                        <x-jet-input-error for="warrantyrepairmodel" class="mt-2" />
                    </div>
                    <div class="px-2 w-auto">
                        <x-jet-label for="warrantyrepairserial" value="{{ __('Serial') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="warrantyrepairserial" />
                        <x-jet-input-error for="warrantyrepairserial" class="mt-2" />
                    </div>
                    <div class="px-2 w-auto">
                        <x-jet-label for="warrantyrepairstart" value="{{ __('Warranty Start') }}" />
                        <x-jet-input class="block mt-1 w-full" type="date" required wire:model.defer="warrantyrepairstart" />
                        <x-jet-input-error for="warrantyrepairstart" class="mt-2" />
                    </div>
                    <div class="px-2 w-auto">
                        <x-jet-label for="warrantyrepairend" value="{{ __('Warranty End') }}" />
                        <x-jet-input class="block mt-1 w-full" type="date" required wire:model.defer="warrantyrepairend" />
                        <x-jet-input-error for="warrantyrepairend" class="mt-2" />
                    </div>
                    <div class="px-2 w-auto">
                        <x-jet-label for="warrantyrepairperson" value="{{ __('Contact Person') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="warrantyrepairperson" />
                        <x-jet-input-error for="warrantyrepairperson" class="mt-2" />
                    </div>
                    <div class="px-2 w-auto">
                        <x-jet-label for="warrantyrepairphone" value="{{ __('Contact Number') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="warrantyrepairphone" />
                        <x-jet-input-error for="warrantyrepairphone" class="mt-2" />
                    </div>
                    <div class="px-2 w-auto">
                        <x-jet-label for="warrantyrepairemail" value="{{ __('Contact Email') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="warrantyrepairemail" />
                        <x-jet-input-error for="warrantyrepairemail" class="mt-2" />
                    </div>
                    <div class="px-2 w-auto">
                        <x-jet-label for="warrantyrepairaddress" value="{{ __('Address') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="warrantyrepairaddress" />
                        <x-jet-input-error for="warrantyrepairaddress" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="warrantyrepairL2" value="{{ __('L2 Approver') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="warrantyrepairL2" />
                        <option value=""> Select </option>
                        @foreach ($L2 as $id)
                        <option value="{{$id->id}}"> {{$id->name}} </option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="warrantyrepairL2" class="mt-2" />
                    </div>

                </div>
                @endif

                @if($task_id == "5")
                <div class="mb-1">
                    <div class="px-2 w-auto">
                        <x-jet-label for="invoicerequestRFQ" value="{{ __('Have you advised RFQ that quote is WON?') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="invoicerequestRFQ" />
                        <option value=""> Select </option>
                        <option value="1"> No </option>
                        <option value="2"> Yes </option>
                        </select>
                        <x-jet-input-error for="invoicerequestRFQ" class="mt-2" />
                    </div>
                    <div class="px-2 w-auto">
                        <x-jet-label for="invoicerequestquote" value="{{ __('Quote') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="invoicerequestquote" />
                        <x-jet-input-error for="invoicerequestquote" class="mt-2" />
                    </div>

                </div>
                @endif

                @if($task_id == "6")
                <div class="mb-1">
                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechsupport_types_id" value="{{ __('Support Type') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="sowithtechsupport_types_id" />
                        <option value=""> Select </option>

                        @foreach($supporttypes as $type)
                        <option value="{{$type->id}}"> {{$type->name}}</option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="sowithtechsupport_types_id" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechdisplay_status" value="{{ __('Display Status') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="sowithtechdisplay_status" />
                        <option value=""> Select </option>
                        <option value="0"> Displaying </option>
                        <option value="1"> None </option>
                        <option value="2"> N/A </option>
                        </select>
                        <x-jet-input-error for="sowithtechdisplay_status" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechtechs_required" value="{{ __('No. of Technicians Required') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="sowithtechtechs_required" />
                        <x-jet-input-error for="sowithtechtechs_required" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechjob" value="{{ __('Job Required') }}" />
                        <textarea rows="5" cols="42" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text" required wire:model.defer="sowithtechjob" /> </textarea>
                        <x-jet-input-error for="sowithtechjob" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechtools" value="{{ __('Tools Needed') }}" />
                        <textarea rows="5" cols="42" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text" required wire:model.defer="sowithtechtools" /> </textarea>
                        <x-jet-input-error for="sowithtechtools" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechwarranty" value="{{ __('Warranty Status') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="sowithtechwarranty" />
                        <option value=""> Select </option>
                        <option value="0"> Yes </option>
                        <option value="1"> No </option>
                        </select>
                        <x-jet-input-error for="sowithtechwarranty" class="mt-2" />
                    </div>

                    @if($sowithtechwarranty == "1")
                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechquote" value="{{ __('Quote') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="sowithtechquote" />
                        <x-jet-input-error for="sowithtechquote" class="mt-2" />
                    </div>
                    @endif

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechdevice_disposal" value="{{ __('Hardware Disposal Status') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="sowithtechdevice_disposal" />
                        <option value=""> Select </option>
                        <option value="0"> Store </option>
                        <option value="1"> Engagis </option>
                        <option value="2"> N/A </option>
                        </select>
                        <x-jet-input-error for="sowithtechdevice_disposal" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechdevice_name" value="{{ __('Device Name') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="sowithtechdevice_name" />
                        <x-jet-input-error for="sowithtechdevice_name" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechdevice_type" value="{{ __('Device Type') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="sowithtechdevice_type" />
                        <option value=""> Select </option>

                        @foreach($devicetypes as $type)
                        <option value="{{$type->id}}"> {{$type->name}}</option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="sowithtechdevice_type" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechLTstatus" value="{{ __('Labtech Status') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="sowithtechLTstatus" />
                        <option value=""> Select </option>
                        <option value="0"> Online </option>
                        <option value="1"> Offline </option>
                        <option value="2"> N/A </option>
                        </select>
                        <x-jet-input-error for="sowithtechLTstatus" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechissue" value="{{ __('Issue Reported') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="sowithtechissue" />
                        <x-jet-input-error for="sowithtechissue" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechreason" value="{{ __('Replacement Reason') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="sowithtechreason" />
                        <option value=""> Select </option>
                        @foreach($replacementreasons as $reason)
                        <option value="{{$reason->id}}"> {{$reason->name}} </option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="sowithtechreason" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechconnection_type" value="{{ __('Connection Type') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="sowithtechconnection_type" />
                        <option value=""> Select </option>
                        <option value="0"> Wired </option>
                        <option value="1"> Wireless </option>
                        </select>
                        <x-jet-input-error for="sowithtechconnection_type" class="mt-2" />
                    </div>

                    @if($sowithtechconnection_type == "1")
                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechwifi_name" value="{{ __('Wifi Name') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="sowithtechwifi_name" />
                        <x-jet-input-error for="sowithtechwifi_name" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechwifi_password" value="{{ __('Wifi Password') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="sowithtechwifi_password" />
                        <x-jet-input-error for="sowithtechwifi_password" class="mt-2" />
                    </div>
                    @endif

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechnetwork_type" value="{{ __('Connection Type') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="sowithtechnetwork_type" />
                        <option value=""> Select </option>
                        <option value="0"> DHCP </option>
                        <option value="1"> Static </option>
                        </select>
                        <x-jet-input-error for="sowithtechnetwork_type" class="mt-2" />
                    </div>

                    @if($sowithtechnetwork_type == "1")
                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechIP" value="{{ __('IP Address') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="sowithtechIP" />
                        <x-jet-input-error for="sowithtechIP" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechsubnet" value="{{ __('Subnet Mask') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="sowithtechsubnet" />
                        <x-jet-input-error for="sowithtechsubnet" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechDG" value="{{ __('Default GateWay') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="sowithtechDG" />
                        <x-jet-input-error for="sowithtechDG" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechDNS" value="{{ __('DNS') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="sowithtechDNS" />
                        <x-jet-input-error for="sowithtechDNS" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechDNS2" value="{{ __('DNS2') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="sowithtechDNS2" />
                        <x-jet-input-error for="sowithtechDNS2" class="mt-2" />
                    </div>
                    @endif


                    @if($sowithtechdevice_type == "1")
                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechSevenEleven" value="{{ __('7-Evelen Player') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="sowithtechSevenEleven" />
                        <option value=""> Select </option>
                        <option value="0"> No </option>
                        <option value="1"> Yes </option>
                        </select>
                        <x-jet-input-error for="sowithtechSevenEleven" class="mt-2" />
                    </div>

                    @if($sowithtechSevenEleven == "1")
                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechstore_id" value="{{ __('Store ID') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model="sowithtechstore_id" />
                        <x-jet-input-error for="sowithtechstore_id" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechpostcode" value="{{ __('Post Code') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model="sowithtechpostcode" />
                        <x-jet-input-error for="sowithtechpostcode" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechpasscode" value="{{ __('Pass Code') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model="sowithtechpasscode" />
                        <x-jet-input-error for="sowithtechpasscode" class="mt-2" />
                    </div>
                    @endif

                    @endif

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechapplication" value="{{ __('Application') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="sowithtechapplication" />
                        <option value=""> Select </option>
                        @foreach($applications as $reason)
                        <option value="{{$reason->id}}"> {{$reason->name}} </option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="sowithtechapplication" class="mt-2" />
                    </div>

                    @if($sowithtechapplication == "9")
                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechmatrox" value="{{ __('7-Evelen Player') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="sowithtechmatrox" />
                        <option value=""> Select </option>
                        <option value="0"> No </option>
                        <option value="1"> Yes </option>
                        </select>
                        <x-jet-input-error for="sowithtechmatrox" class="mt-2" />
                    </div>
                    @endif

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechsolution_type" value="{{ __('Solution Type') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="sowithtechsolution_type" />
                        <option value=""> Select </option>
                        @foreach($solutiontypes as $reason)
                        <option value="{{$reason->id}}"> {{$reason->name}} </option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="sowithtechsolution_type" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechorientation" value="{{ __('Orientation') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="sowithtechorientation" />
                        <option value=""> Select </option>
                        <option value="0"> Portrait </option>
                        <option value="1"> Landscape </option>
                        </select>
                        <x-jet-input-error for="sowithtechorientation" class="mt-2" />
                    </div>

                    @if($sowithtechdevice_type == "2")
                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechserial_number" value="{{ __('Serial Number') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="sowithtechserial_number" />
                        <x-jet-input-error for="sowithtechserial_number" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechscreen_model" value="{{ __('Screen Model') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="sowithtechscreen_model" />
                        <x-jet-input-error for="sowithtechscreen_model" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechend" value="{{ __('Warranty End') }}" />
                        <x-jet-input class="block mt-1 w-full" type="date" required wire:model.defer="sowithtechend" />
                        <x-jet-input-error for="sowithtechend" class="mt-2" />
                    </div>
                    @endif

                    @if($sowithtechdevice_type == "3")
                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechnetwork_device_type" value="{{ __('Network Device Type') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="sowithtechnetwork_device_type" />
                        <option value=""> Select </option>
                        <option value="0"> Router </option>
                        <option value="1"> Switch </option>
                        </select>
                        <x-jet-input-error for="sowithtechnetwork_device_type" class="mt-2" />
                    </div>
                    @endif

                    @if($sowithtechdevice_type == "4")
                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechprojector_model" value="{{ __('Projector Model') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="sowithtechprojector_model" />
                        <x-jet-input-error for="sowithtechprojector_model" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechprojector_lamp" value="{{ __('Projector Lamp') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="sowithtechprojector_lamp" />
                        <x-jet-input-error for="sowithtechprojector_lamp" class="mt-2" />
                    </div>
                    @endif

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechnotes" value="{{ __('Additional Notes/Special Instructions') }}" />
                        <textarea rows="5" cols="42" class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text" required wire:model.defer="sowithtechnotes" /> </textarea>
                        <x-jet-input-error for="sowithtechnotes" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechL2" value="{{ __('L2 Approver') }}" />
                        <select class="mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model="sowithtechL2" />
                        <option value=""> Select </option>
                        @foreach ($L2 as $id)
                        <option value="{{$id->id}}"> {{$id->name}} </option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="sowithtechL2" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechperson" value="{{ __('Contact Person') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="sowithtechperson" />
                        <x-jet-input-error for="sowithtechperson" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechphone" value="{{ __('Contact Number') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="sowithtechphone" />
                        <x-jet-input-error for="sowithtechphone" class="mt-2" />
                    </div>

                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechemail" value="{{ __('Contact Email') }}" />
                        <x-jet-input class="block mt-1 w-full" type="email" required wire:model.defer="sowithtechemail" />
                        <x-jet-input-error for="sowithtechemail" class="mt-2" />
                    </div>


                    <div class="px-2 w-auto">
                        <x-jet-label for="sowithtechaddress" value="{{ __('Delivery Address') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="sowithtechaddress" />
                        <x-jet-input-error for="sowithtechaddress" class="mt-2" />
                    </div>

                </div>
                @endif

                @if($task_id == "7")
                <div class="mb-1">
                    <div class="px-2 w-auto">
                        <x-jet-label for="returnauthorizationserial_number" value="{{ __('Serial Number') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" required wire:model.defer="returnauthorizationserial_number" />
                        <x-jet-input-error for="returnauthorizationserial_number" class="mt-2" />
                    </div>
                </div>

                @endif

                <hr class="mt-1">

            </x-slot>

            <x-slot name="footer">

                <x-jet-button class="ml-2" wire:click="TaskAdd()" wire:loading.attr="disabled">
                    {{ __('Add Task') }}
                </x-jet-button>
                <x-jet-secondary-button wire:click="$set('confirmAdd', false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

            </x-slot>
        </x-jet-dialog-modal>

        <!-- Archive Task Confirmation Modal -->
        <x-jet-confirmation-modal wire:model="Archive">
            <x-slot name="title">
                {{ __('Archive Task') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to arhive this task?') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-danger-button class="ml-2" wire:click="ArchiveTask( {{$Archive}})" wire:loading.attr="disabled">
                    {{ __('Archive') }}
                </x-jet-danger-button>
                <x-jet-secondary-button wire:click="$set('Archive', false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-confirmation-modal>

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
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$casenumber}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Store: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$store}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Status: </dt>
                        @if ($casestatus == 0)
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                {{$casestatus == 0 ? 'Pending' : '' }} </span>
                        </dd>
                        @endif

                        @if ($casestatus == 1)
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="bg-green-100 text-green-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                {{$casestatus == 1 ? 'Assigned' : '' }} </span>
                        </dd>
                        @endif

                        @if ($casestatus == 2)
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="bg-blue-100 text-blue-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                {{$casestatus == 2 ? 'Completed' : '' }} </span>
                        </dd>
                        @endif

                    </div>
                    <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500"> Task Type: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$task_id }}</dd>
                        <dt class="text-sm font-medium text-gray-500"> Owner: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$users_id}}</dd>
                        <dt class="text-sm font-medium text-gray-500"> Assigned: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">

                            @if ($admin_assigned !== null)
                            <span class="bg-indigo-100 text-indigo-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                {{$admin_assigned}}</span>
                        </dd>
                        @endif

                    </div>
                </div>

                <hr class="mb-2 mt-2">

                @if($FUR != null)
                <div class="flex flex-wrap justify-between">
                    <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500"> Contact Person: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$faultyunitreturnperson }}</dd>
                        <dt class="text-sm font-medium text-gray-500"> Contact Number: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$faultyunitreturnphone }}</dd>
                        <dt class="text-sm font-medium text-gray-500"> Contact Email: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$faultyunitreturnemail }}</dd>
                        <dt class="text-sm font-medium text-gray-500"> Contact Address: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$faultyunitreturnaddress }}</dd>
                        <dt class="text-sm font-medium text-gray-500"> L1 Notes: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$faultyunitreturnnotes }}</dd>
                    </div>
                </div>
                @endif

                @if($HR != null)
                <div class="flex flex-wrap justify-between">

                    <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                        @if($hardwareplacementwarranty == 0)
                        <dt class="text-sm font-medium text-gray-500"> Device in Warranty: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">

                            @if($hardwareplacementquote != null)
                            <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4"> {{$hardwareplacementquote}} </span>
                            @else
                            <span class="bg-indigo-100 text-indigo-600 text-xs font-semibold rounded-2xl py-1 px-4"> Yes </span>
                            @endif
                        </dd>
                        @endif

                        <dt class="text-sm font-medium text-gray-500"> Solution Type: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="bg-green-100 text-green-600 text-xs font-semibold rounded-2xl py-1 px-4"> {{$hardwareplacementsupport_types_id}} </span>
                        </dd>

                        @if($hardwareplacementdevice_disposal == 0)
                        <dt class="text-sm font-medium text-gray-500"> Device Disposal: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="bg-blue-100 text-blue-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                Store
                        </dd>
                        @endif

                        @if($hardwareplacementdevice_disposal == 1)
                        <dt class="text-sm font-medium text-gray-500"> Device Disposal: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                Engagis
                        </dd>
                        @endif

                        <dt class="text-sm font-medium text-gray-500"> Device Name: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementdevice_name}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Device Type: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementdevice_type}} </dd>

                        @if($hardwareplacementSevenEleven == 1)
                        <dt class="text-sm font-medium text-gray-500"> 7-Eleven Player: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> Yes </dd>

                        <dt class="text-sm font-medium text-gray-500"> Store ID: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementstore_id}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> POSTCODE: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementpostcode}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> PASSCODE: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementpasscode}} </dd>
                        @endif

                        @if($hardwareplacementLTstatus != 2)
                        <dt class="text-sm font-medium text-gray-500"> LT Status: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementLTstatus == 0 ? 'Offline' : 'Online'}} </dd>
                        @endif

                        <dt class="text-sm font-medium text-gray-500"> Issue Reported: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementissue}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Replacement Reason: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementreason}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Connection Type: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementconnection_type == 0 ? 'Wired' : 'Wireless'}} </dd>

                        @if($hardwareplacementconnection_type == 1)
                        <dt class="text-sm font-medium text-gray-500"> Wifi Name: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementwifi_name}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Wifi Password: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementwifi_password}} </dd>
                        @endif

                        <dt class="text-sm font-medium text-gray-500"> Network Type: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementnetwork_type == 0 ? 'DHCP': 'Static' }} </dd>

                        @if($hardwareplacementnetwork_type == 1)
                        <dt class="text-sm font-medium text-gray-500"> IP Address: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementIP}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Subnet Mask: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementsubnet}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Default Gateway: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementDG}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> DNS 1: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementDNS}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> DNS 2: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementDNS2}} </dd>
                        @endif

                        <dt class="text-sm font-medium text-gray-500"> Application: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementapplication}} </dd>

                        @if($hardwareplacementmatrox == 1)
                        <dt class="text-sm font-medium text-gray-500"> Include Matrox? </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">Yes </span></dd>
                        @endif

                        <dt class="text-sm font-medium text-gray-500"> Solution Type: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementsolution_type}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Orientation: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementorientation == 0 ? 'Landscape' : 'Portrait'}} </dd>

                        @if($hardwareplacementdevice_type == 2)
                        <dt class="text-sm font-medium text-gray-500"> Screen Model: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementscreen_model}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Serial Number: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementserial_number}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Warranty End Date: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementend}} </dd>
                        @endif

                        @if($hardwareplacementdevice_type == 3)
                        <dt class="text-sm font-medium text-gray-500"> Network Device Type: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementnetwork_device_type}} </dd>
                        @endif

                        @if($hardwareplacementdevice_type == 4)
                        <dt class="text-sm font-medium text-gray-500"> Projector Model: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementprojector_model}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Projector Lamp: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementprojector_lamp}} </dd>
                        @endif

                        <dt class="text-sm font-medium text-gray-500"> Notes: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementnotes}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> L2 Approver: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementL2}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Site Contact: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementperson}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Phone: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementphone}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Email </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementemail}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Address </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$hardwareplacementaddress}} </dd>
                    </div>
                </div>
                @endif

                @if($HRWT != null)
                <div class="flex flex-wrap justify-between">

                    <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                        @if($sowithtechwarranty == 0)
                        <dt class="text-sm font-medium text-gray-500"> Device in Warranty: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">

                            @if($sowithtechquote != null)
                            <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4"> {{$sowithtechquote}} </span>
                            @else
                            <span class="bg-indigo-100 text-indigo-600 text-xs font-semibold rounded-2xl py-1 px-4"> Yes </span>
                            @endif
                        </dd>
                        @endif

                        <dt class="text-sm font-medium text-gray-500"> Solution Type: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="bg-green-100 text-green-600 text-xs font-semibold rounded-2xl py-1 px-4"> {{$sowithtechsupport_types_id}} </span>
                        </dd>

                        @if($sowithtechdevice_disposal == 0)
                        <dt class="text-sm font-medium text-gray-500"> Device Disposal: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="bg-blue-100 text-blue-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                Store
                        </dd>
                        @endif

                        @if($sowithtechdevice_disposal == 1)
                        <dt class="text-sm font-medium text-gray-500"> Device Disposal: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                Engagis
                        </dd>
                        @endif

                        <dt class="text-sm font-medium text-gray-500"> Device Name: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechdevice_name}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Device Type: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechdevice_type}} </dd>

                        @if($sowithtechSevenEleven == 1)
                        <dt class="text-sm font-medium text-gray-500"> 7-Eleven Player: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> Yes </dd>

                        <dt class="text-sm font-medium text-gray-500"> Store ID: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechstore_id}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> POSTCODE: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechpostcode}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> PASSCODE: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechpasscode}} </dd>
                        @endif

                        @if($sowithtechLTstatus != 2)
                        <dt class="text-sm font-medium text-gray-500"> LT Status: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechLTstatus == 0 ? 'Offline' : 'Online'}} </dd>
                        @endif

                        <dt class="text-sm font-medium text-gray-500"> Display Status </dt>

                        @if($sowithtechdisplay_status == 0)
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="bg-indigo-100 text-indigo-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                Displaying
                            </span>
                        </dd>
                        @endif

                        @if($sowithtechdisplay_status == 1)
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                None </span>
                        </dd>
                        @endif

                        @if($sowithtechdisplay_status == 2)
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            N/A </dd>
                        @endif

                        <dt class="text-sm font-medium text-gray-500"> Issue Reported: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechissue}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Replacement Reason: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechreason}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Connection Type: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechconnection_type == 0 ? 'Wired' : 'Wireless'}} </dd>

                        @if($sowithtechconnection_type == 1)
                        <dt class="text-sm font-medium text-gray-500"> Wifi Name: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechwifi_name}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Wifi Password: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechwifi_password}} </dd>
                        @endif

                        <dt class="text-sm font-medium text-gray-500"> Network Type: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechnetwork_type == 0 ? 'DHCP': 'Static' }} </dd>

                        @if($sowithtechnetwork_type == 1)
                        <dt class="text-sm font-medium text-gray-500"> IP Address: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechIP}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Subnet Mask: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechsubnet}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Default Gateway: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechDG}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> DNS 1: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechDNS}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> DNS 2: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechDNS2}} </dd>
                        @endif

                        <dt class="text-sm font-medium text-gray-500"> Application: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechapplication}} </dd>

                        @if($sowithtechmatrox == 1)
                        <dt class="text-sm font-medium text-gray-500"> Include Matrox? </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">Yes </span></dd>
                        @endif

                        <dt class="text-sm font-medium text-gray-500"> Solution Type: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechsolution_type}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Orientation: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechorientation == 0 ? 'Landscape' : 'Portrait'}} </dd>

                        @if($sowithtechdevice_type == 2)
                        <dt class="text-sm font-medium text-gray-500"> Screen Model: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechscreen_model}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Serial Number: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechserial_number}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Warranty End Date: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechend}} </dd>
                        @endif

                        @if($sowithtechdevice_type == 3)
                        <dt class="text-sm font-medium text-gray-500"> Network Device Type: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechnetwork_device_type}} </dd>
                        @endif

                        @if($sowithtechdevice_type == 4)
                        <dt class="text-sm font-medium text-gray-500"> Projector Model: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechprojector_model}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Projector Lamp: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechprojector_lamp}} </dd>
                        @endif

                        <dt class="text-sm font-medium text-gray-500"> Notes: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechnotes}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> L2 Approver: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechL2}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Site Contact: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechperson}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Phone: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechphone}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Email </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechemail}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Address </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechaddress}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Techs Required </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechtechs_required}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Job Required </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechjob}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Tools </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$sowithtechtools}} </dd>
                    </div>
                </div>
                @endif

                @if($IR != null)
                <div class="flex flex-wrap justify-between">
                    <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500"> Quote: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$invoicerequestquote}} </dd>
                        <dt class="text-sm font-medium text-gray-500 w-full"> Advised RFQ Quote is WON?: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            @if($invoicerequestRFQ == 0)
                            <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                Not Yet </span>
                            @endif
                            @if($invoicerequestRFQ == 1)
                            <span class="bg-green-100 text-green-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                Yes </span>
                            @endif
                        </dd>
                    </div>
                </div>
                @endif

                @if($RA != null)
                <div class="flex flex-wrap justify-between">
                    <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500"> Serial Number: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$returnauthorizationserial_number}} </dd>
                    </div>
                </div>
                @endif

                @if($TR != null)
                <div class="flex flex-wrap justify-between">
                    <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500"> Issue Reported: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$technicianrequestissue}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Device Name: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$technicianrequestdevice_name}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Device Type: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$technicianrequestdevice_type}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Solution Type: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$technicianrequestsupport_types_id}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Display Status </dt>

                        @if($technicianrequestdisplay_status == 0)
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="bg-indigo-100 text-indigo-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                Displaying
                            </span>
                        </dd>
                        @endif

                        @if($technicianrequestdisplay_status == 1)
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                None </span>
                        </dd>
                        @endif

                        @if($technicianrequestdisplay_status == 2)
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            N/A </dd>
                        @endif

                        <dt class="text-sm font-medium text-gray-500"> LT Status: </dt>

                        @if($technicianrequestLTstatus == 0)
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4"> Offline </span>
                        </dd>
                        @endif

                        @if($technicianrequestLTstatus == 1)
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="bg-green-100 text-green-600 text-xs font-semibold rounded-2xl py-1 px-4"> Online </span>
                        </dd>
                        @endif

                        @if($technicianrequestLTstatus == 2)
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="bg-blue-100 text-blue-600 text-xs font-semibold rounded-2xl py-1 px-4"> N/A </span>
                        </dd>
                        @endif


                        <dt class="text-sm font-medium text-gray-500"> Contact: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$technicianrequestperson}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Phone: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$technicianrequestphone}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Email: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$technicianrequestemail}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Address: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$technicianrequestaddress}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> L2 Approver: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$technicianrequestL2}} </dd>


                        @if($technicianrequestwarranty == 1)
                        <dt class="text-sm font-medium text-gray-500"> Warranty</dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                No </span>
                        </dd>
                        <dt class="text-sm font-medium text-gray-500"> Quote</dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$technicianrequestquote}} </dd>
                        @endif

                        @if($technicianrequestdevice_disposal != 2)
                        <dt class="text-sm font-medium text-gray-500"> Device Disposal</dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">

                            @if($technicianrequestdevice_disposal == 0)
                            <span class="bg-blue-100 text-blue-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                Store </span> @endif

                            @if($technicianrequestdevice_disposal == 1)
                            <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                Engagis </span> @endif

                        </dd>
                        @endif

                        <dt class="text-sm font-medium text-gray-500"> Techs Required </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$technicianrequesttechs_required}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Job Required </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$technicianrequestjob}} </dd>

                        <dt class="text-sm font-medium text-gray-500"> Tools </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$technicianrequesttools}} </dd>


                    </div>
                </div>

                @endif


                @if($WR != null)
                <div class="flex flex-wrap justify-between">
                    <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6 w-full">
                        <dt class="text-sm font-medium text-gray-500"> Reason for Repair: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$warrantyrepairreason}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Software Version: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$warrantyrepairsoftware}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Firmware Version: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$warrantyrepairfirmware}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Brand: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$warrantyrepairbrand}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Model: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$warrantyrepairmodel}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Serial Number: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$warrantyrepairserial}} </dd>
                    </div>
                    <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6 w-full mt-2">

                        <dt class="text-sm font-medium text-gray-500"> Warranty Start: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$warrantyrepairstart }} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Warranty End: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$warrantyrepairend}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Contact Person: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$warrantyrepairperson}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Phone: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$warrantyrepairphone}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Email: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$warrantyrepairemail}} </dd>
                        <dt class="text-sm font-medium text-gray-500"> Address: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$warrantyrepairaddress }} </dd>
                        <dt class="text-sm font-medium text-gray-500"> L2 Approver: </dt>
                        <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4">
                                {{$warrantyrepairL2}} </span>
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



    </div>