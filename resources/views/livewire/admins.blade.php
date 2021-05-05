<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Aministrateur ALAL Money
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Creer un nouveau Administrateur</button>
            @if($isOpen)
                @include('livewire.create')
            @endif
            <div class="overflow-x-auto">
                 <table class="min-w-max w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">Prenom</th>
                                        <th class="py-3 px-6 text-left">Nom</th>
                                        <th class="py-3 px-6 text-center">Telephone</th>
                                        <th class="py-3 px-6 text-center">Email</th>
                                        <th class="py-3 px-6 text-center">Sexe</th>
                                        <th class="py-3 px-6 text-center">Matricule</th>
                                        <th class="py-3 px-6 text-center">Profile</th>
                                        <th class="py-3 px-6 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach($admins as $admin)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="mr-2">
                                                    <img src="img/icon1.svg" alt="">
                                                </div>
                                                <span class="font-medium">{{$admin->prenom}}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <div class="flex items-center">
                                                <div class="mr-2">
                                                    <img src="img/icon2.svg" alt="">
                                                </div>
                                                <span>{{$admin->nom}}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex items-center justify-center">
                                                <span>{{$admin->telephone}}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{$admin->email}}</span>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex items-center justify-center">
                                                <span>{{$admin->sexe}}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex items-center justify-center">
                                                <span>{{$admin->matricule}}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex items-center justify-center">
                                                <span class="bg-yellow-200 text-black-600 py-1 px-3 rounded-full text-xs">{{$admin->profil}}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-center">
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <button wire:click="edit({{ $admin->id }})">
                                                        <img src="img/lire.svg" alt="">
                                                    </button>
                                                </div>
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <button wire:click="edit({{ $admin->id }})">
                                                        <img src="img/pen.svg" alt="">
                                                    </button>
                                                    
                                                </div>
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <button wire:click="delete({{ $admin->id }})">
                                                        <img src="img/trash.svg" alt="">
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>               
            </div>                  
        </div>
    </div>
</div>