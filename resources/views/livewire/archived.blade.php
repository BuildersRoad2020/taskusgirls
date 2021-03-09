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




    </div>
    <!-- End Tools -->

    <!-- Start Table -->

    <table class="overflow-x-auto w-full bg-white">
        <thead class="bg-blue-100 border-b border-gray-300">
            <tr>
                <th class="p-4 text-left text-sm font-bold text-gray-500">Date Created</th>
                <th class="p-4 text-left text-sm font-bold text-gray-500">Date Archived</th>
                <th class="p-4 text-left text-sm font-bold text-gray-500">Case</th>
                <th class="p-4 text-left text-sm font-bold text-gray-500">Client</th>
                <th class="p-4 text-left text-sm font-bold text-gray-500">Task Type</th>
                <th class="p-4 text-left text-sm font-bold text-gray-500">Owner</th>
                <th class="p-4 text-left text-sm font-bold text-gray-500">Status</th>
                <th class="p-4 text-left text-sm font-bold text-gray-500">Action</th>
                <th class="p-4 text-left text-sm font-bold text-gray-500"></th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm divide-y divide-gray-300">
            <tr class="bg-white font-medium text-sm divide-y divide-gray-200">
                @foreach($tasks as $task)
                <td class="p-4 whitespace-nowrap"> {{$task->created_at }}</td>
                <td class="p-4 whitespace-nowrap"> {{$task->updated_at }}</td>
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

                    @if($task->status == 4)
                    <span class="bg-green-100 text-green-600 text-xs font-semibold rounded-2xl py-1 px-4"> Archived </span>
                    @endif
                </td>

                <td class="p-4 whitespace-nowrap">


                    <button class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-4 py-2 rounded-md border-0" wire:click="confirmingGrab( {{$task->id }})" wire:loading.attr="disabled"> Restore </button>



                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Restore Task Confirmation Modal -->
    <x-jet-confirmation-modal wire:model="confirmGrab">
        <x-slot name="title">
            {{ __('Restore Task') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to restore this task?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-button class="ml-2" wire:click="Grab( {{$confirmGrab}})" wire:loading.attr="disabled">
                {{ __('Restore') }}
            </x-jet-button>
            <x-jet-secondary-button wire:click="$set('confirmGrab', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-confirmation-modal>

    <div class="mt-4" data-turbolinks="false">
        {{ $tasks->links() }}
    </div>
</div>