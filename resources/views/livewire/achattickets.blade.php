<x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        Espace Administrateur ALAL: Achat de ticket

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

            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Acheter un ticket</button>

            @if($isOpen)

                @include('livewire.createAchatTicket')

            @endif

            <table class="table-fixed w-full">

                <thead>

                    <tr class="bg-gray-100">

                        <th class="px-4 py-2 w-20">Date Achat</th>
                        <th class="px-4 py-2 w-20">Prix Ticket</th>

                        <th class="px-4 py-2">QR_code</th>

                        <th class="px-4 py-2">E-mail acheteur</th>

                        <th class="px-4 py-2">Evènement</th>

                        <th class="px-4 py-2">Point de vente acheter</th>

                        

                        <th class="px-4 py-2">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($achattickets as $achatticket)

                    <tr>

                        <td class="border px-4 py-2">{{ $achatticket->created_at }}</td>
                        <td class="border px-4 py-2">{{ $achatticket->montant }}</td>

                        <td class="border px-4 py-2">{{ $achatticket->qr_code }}</td>

                        <td class="border px-4 py-2">{{ $achatticket->email_acheteur }}</td>
                        {{-- <td class="border px-4 py-2">{{ $achatticket->evenement->nom_evenement }}</td> --}}
                        <td class="border px-4 py-2">{{ $achatticket->evenement->nom_evenement }}</td>

                        <td class="border px-4 py-2">{{ $achatticket->pointdevente->adresse }}</td>
                       

                        <td class="border px-4 py-2">

                        <button wire:click="edit({{ $achatticket->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>

                            <button wire:click="delete({{ $achatticket->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>