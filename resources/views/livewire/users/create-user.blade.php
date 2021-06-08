<div>
    <x-jet-danger-button wire:click="$set('open', true )">
        Crear Nuevo Usuario
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Crear nuevo usuario
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Nombre de usuario" />
                <x-jet-input class="w-full" type="text" wire:model.defer="name"/>
                <x-jet-input-error for="name"/>
            </div>

            <div class="mb-4" wire:ignore>
                <x-jet-label value="E-mail"  />
                <x-jet-input class="w-full" type="email" wire:model.defer="email"/>
                <x-jet-input-error for="email"/>
            </div>

            <div class="mb-4" wire:ignore>
                <x-jet-label value="Password" />
                <x-jet-input wire:model.defer="password" type="password" class="w-full" />
                <x-jet-input-error for="password"/>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false )">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">
                Crear Usuario
            </x-jet-danger-button >



        </x-slot>

    </x-jet-dialog-modal>


</div>
