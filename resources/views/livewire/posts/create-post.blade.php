<div>
    <x-jet-danger-button wire:click="$set('open', true )">
        Crear Nuevo Post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Crear nuevo post
        </x-slot>

        <x-slot name="content">

            <div wire:loading wire:target="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">!Imagen Cargando!</strong>
                <span class="block sm:inline">Espere un momento hasta que la imegen se procese.</span>
              </div>

            @if ($image)
                <img class="mb-4" src="{{ $image->temporaryUrl() }}"> </img>
            @endif

            <div class="mb-4">
                <x-jet-label value="Titulo del post" />
                <x-jet-input class="w-full" type="text" wire:model.defer="title"/>
                <x-jet-input-error for="title"/>
            </div>

            <div class="mb-4" wire:ignore>
                <x-jet-label value="Contenido del post"  />
                <textarea id="editor"
                    class="form-control w-full"
                    rows="6"
                    wire:model="content">
                </textarea>
                <x-jet-input-error for="content"/>
            </div>

            <div>
                <input type="file" wire:model="image" id="$identificador">
                <x-jet-input-error for="image"/>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false )">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save, image" class="disabled:opacity-25">
                Crear Post
            </x-jet-danger-button >



        </x-slot>

    </x-jet-dialog-modal>

    @push('js')
        <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>

        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then(function(editor){
                    editor.model.document.on('change:data', () => {
                        @this.set('content', editor.getData());
                    })
                })
                .catch( error => {
                    console.error( error );
                } );
        </script>
    @endpush

</div>
