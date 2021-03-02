<div>
    <div class="flex flex-col max-w-full overflow-x-hidden shadow-md m-8" wire:poll.5000ms>

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

        @can('viewAny', App\Models\User::class)
        <div class="flex flex-wrap justify-end">
            <div class="m-2 space-x-1 space-y-1">
                <button class="inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-white transition bg-blue-700 rounded-full shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none" wire:click="confirmUserAdd" wire:loading.attr="disabled"> Add User </button>
            </div>
        </div>
        @endcan

        <table class="overflow-x-auto w-full bg-white">
            <thead class="bg-blue-100 border-b border-gray-300">
                <tr>
                    <th class="p-4 text-left text-sm font-bold text-gray-500">User</th>
                    <th class="p-4 text-left text-sm font-bold text-gray-500">Email</th>
                    <th class="p-4 text-left text-sm font-bold text-gray-500">Role</th>
                    <th class="p-4 text-left text-sm font-bold text-gray-500 col-span-2">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm divide-y divide-gray-300">  @foreach ($users as $user)
                <tr class="bg-white font-medium text-sm divide-y divide-gray-200">
                   
                    <td class="p-4 whitespace-nowrap"> {{$user->name}} </td>
                    <td class="p-4 whitespace-nowrap"> {{$user->email}} </td>
                    <td class="p-4 whitespace-nowrap"> @foreach ($user->RoleUser as $id)
                        <span class="{{$id->roles_id == 1 ? 'bg-green-100 text-green-600 text-xs font-semibold rounded-2xl py-1 px-4 mr-2' : 'bg-pink-100 text-pink-600 text-xs font-semibold rounded-2xl py-1 px-4 mr-2' }}"> {{$id->roles_id == 1 ? 'Admin' : 'User' }} </span>
                        @endforeach
                    </td>

                    <td class="p-4 whitespace-nowrap">
                        <button class="border-2 border-indigo-200 rounded-md p-1" wire:click="confirmUserEdit({{$user->id}})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-indigo-500">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </td>

                  
                </tr>   @endforeach
            </tbody>
        </table>

  <!--Add User Modal -->
  <x-jet-dialog-modal wire:model="confirmingUserAdd">
            <x-slot name="title">
                {{ __('Add User') }}
            </x-slot>

            <x-slot name="content">
                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"  required wire:model.defer="name" />
                    <x-jet-input-error for="name" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"  required wire:model.defer="email" />
                    <x-jet-input-error for="email" class="mt-2" />
                </div>

                <div class="mt-4">

                    <x-jet-label for="roles_id" value="{{ __('Role') }}" />
                    <select id="roles_id" class="form-multiselect block mt-1 w-full" multiple name="roles_id" required wire:model.defer="roles_id" />
                    <option value="1"> Admin </option>
                    <option value="2"> User </option>
                    </select>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 mt-3"> You may select multiple roles</span>
                    <x-jet-input-error for="roles_id" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">

                <x-jet-button class="ml-2" wire:click="UserAdd()" wire:loading.attr="disabled">
                    {{ __('Add User') }}
                </x-jet-button>
                <x-jet-secondary-button wire:click="$set('confirmingUserAdd', false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

            </x-slot>
        </x-jet-dialog-modal>     

 <!--Edit User Modal -->
        <x-jet-dialog-modal wire:model="confirmingUserEdit">
            <x-slot name="title">
                {{ __('Edit User') }}
            </x-slot>

            <x-slot name="content">
                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required wire:model.defer="name" />
                    <x-jet-input-error for="name" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full disabled:opacity-50" type="email" name="email" :value="old('email')" required wire:model.defer="email" disabled />
                    <x-jet-input-error for="email" class="mt-2" />
                </div>

                <div class="mt-4">

                    <x-jet-label for="roles_id" value="{{ __('Role') }}" />
                    <select id="roles_id" class="form-multiselect block mt-1 w-full" multiple name="roles_id" required wire:model.defer="roles_id" />
                    <option value="1"> Admin </option>
                    <option value="2"> User </option>
                    </select>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 mt-3"> You may select multiple roles</span>
                    <x-jet-input-error for="roles_id" class="mt-2" />
                </div>                

            </x-slot>

            <x-slot name="footer">

                <x-jet-danger-button class="ml-2" wire:click="EditUser({{ $confirmingUserEdit}})" wire:loading.attr="disabled">
                    {{ __('Edit Account') }}
                </x-jet-danger-button>
                <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                </x-jet-secondary-button>

            </x-slot>
        </x-jet-dialog-modal>           

    </div>

</div>