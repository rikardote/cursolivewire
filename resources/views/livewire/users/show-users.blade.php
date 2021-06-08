<div wire:init="loadPost">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <x-table>
            <div class="px-6 py-4 flex items-center">

                <div class="flex items-center">
                    <span>Mostrar</span>
                    <select wire:model="cant" class="mx-2 form-control">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>Entradas</span>
                </div>

                <x-jet-input class="flex-1 mx-4" placeholder="Que buscas?" type="text" wire:model="search" />
                @livewire('create-user')

            </div>
            @if (count($users))
                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('id')">
                                ID

                                @if ($sort == 'id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"> </i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"> </i>
                                    @endif

                                @else
                                    <i class="fas fa-sort float-right mt-1"> </i>
                                @endif

                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('name')">
                                Name
                                @if ($sort == 'name')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"> </i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"> </i>
                                    @endif

                                @else
                                    <i class="fas fa-sort float-right mt-1"> </i>
                                @endif
                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('email')">
                                Email

                                @if ($sort == 'email')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"> </i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"> </i>
                                    @endif

                                @else
                                    <i class="fas fa-sort float-right mt-1"> </i>
                                @endif

                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $item)
                            <tr>
                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">
                                        {{ $item->id }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">
                                        {{ $item->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">
                                        {!! $item->email !!}
                                    </div>
                                </td>
                                <td class="px-6 py-4  text-sm font-medium flex">
                                    {{-- @livewire('edit-post',['post' => $post], key($post->id)) --}}
                                    <a class="btn btn-green" wire:click="edit({{ $item->id }})">
                                        <i class="fas fa-edit"> </i>
                                    </a>
                                    <a class="btn btn-red ml-2" wire:click="$emit('deletePost', {{ $item->id }})">
                                        <i class="fas fa-trash"> </i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                @if ($users->hasPages())
                    <div class="px-6 py-3">
                        {{ $users->links() }}
                    </div>
                @endif
            @else
                <div class="px-6 py-4">
                    No existe ningun registro coincidente
                </div>
            @endif




        </x-table>
    </div>

    <x-jet-dialog-modal wire:model="open_edit">
        <x-slot name='title'>
            Editar el usuario
        </x-slot>

        <x-slot name='content'>
            <div class="mb-4">
                <x-jet-label value="Usuario" />
                <x-jet-input wire:model="user.name" type="text" class="w-full" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Email" />
                <x-jet-input wire:model="user.email" type="email" class="w-full" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Password"/>
                <x-jet-input wire:model.defer="user.password" type="password" class="w-full" />
            </div>

        </x-slot>

        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="$set('open_edit', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" class="disabled:opacity-25">
                Actualizar
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

    @push('js')

    @endpush
</div>
