<x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        Espace Point de vente ALAL: achat ticket

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

            {{-- <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Achat ticket</button>

            @if($isOpen)

                @include('livewire.createEvenement')

            @endif --}}

            <table class="table-fixed w-full">

                <thead>

                    <tr class="bg-gray-100">

                        <th class="px-4 py-2 w-20">Nom évènement</th>
                        <th class="px-4 py-2 w-20">Date évènement</th>

                        <th class="px-4 py-2">Liste ASC</th>

                        <th class="px-4 py-2">Lieu</th>

                        <th class="px-4 py-2">Prix ticket1</th>

                        <th class="px-4 py-2">Prix ticket2</th>

                        <th class="px-4 py-2">Prix ticket3</th>

                        <th class="px-4 py-2">Prix ticket4</th>

                        <th class="px-4 py-2">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($evenements as $evenement)

                    <tr>

                        <td class="border px-4 py-2">{{ $evenement->nom_evenement}}</td>
                        <td class="border px-4 py-2">{{ $evenement->date_evenement}}</td>

                        <td class="border px-4 py-2">{{ $evenement->liste_asc }}</td>

                        <td class="border px-4 py-2">{{ $evenement->lieu_evenement }}</td>
                        <td class="border px-4 py-2">{{ $evenement->prix_ticket1 }}</td>

                        <td class="border px-4 py-2">{{ $evenement->prix_ticket2 }}</td>
                        <td class="border px-4 py-2">{{ $evenement->prix_ticket3 }}</td>

                        <td class="border px-4 py-2">{{ $evenement->prix_ticket4 }}</td>

                        <td class="border px-4 py-2">{{ $evenement->zone->nom }}</td>

                        <td class="border px-4 py-2">

                        <button wire:click="edit({{ $evenement->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>

                            <button wire:click="delete({{ $evenement->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Acheter ticket</button>

            @if($isOpen)

                @include('livewire.createAchatTicket')

            @endif
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>