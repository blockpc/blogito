<div>
    @if ($images->count() < 6)
        {{-- <div class="md:col-span-6">
                <div class="border border-dashed border-gray-500 relative m-4 pb-2" id="dropzpne-images">
                <form action="{{ route('dropzone.store', $post) }}" method="post" enctype="multipart/form-data" id="dropzone" class="dropzone">
                    @csrf
                    <div class="dz-message">
                        <h3 class="text-sx sm:text-base m-2">{{__('Upload Multiple Image By Click On Box')}}</h3>
                    </div>
                </form>
            </div>
        </div> --}}
        <form class="pb-4" wire:submit.prevent="save" enctype="multipart/form-data">
            <div class="md:grid md:grid-cols-6 md:gap-6 content-center">
                <div class="md:col-span-{{($photos) ? 6 - count($photos) : 6 }}">
                    <div class="flex flex-col flex-grow mb-3">
                        <div id="FileUpload" class="block w-full py-2 px-3 relative bg-white appearance-none border-2 border-gray-300 border-solid rounded-md hover:shadow-outline-gray">
                            <input wire:model="photos" type="file" multiple class="absolute inset-0 z-30 m-0 p-0 w-full h-full outline-none opacity-0" id="photos">
                            <div class="flex flex-col space-y-2 items-center justify-center">
                                <i class="fas fa-cloud-upload-alt fa-3x text-currentColor"></i>
                                <p class="text-gray-700">{{__('Upload Multiple Image By Click On Box')}}. Máx: {{$max}}</p>
                                <a href="javascript:void(0)" class="flex items-center mx-auto py-2 px-4 text-white text-center font-medium border border-transparent rounded-md outline-none bg-red-700">{{__('Select a file')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($photos)
                    @foreach ($photos as $index =>  $photo)
                        <div class="md:col-span-1 relative">
                            <img class="w-full" src="{{ $photo->temporaryUrl() }}">
                            <div class="absolute top-2 right-2">
                                <button wire:click="quitar({{$index}})" type="button" class="btn-xs btn-danger">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                    <div class="md:col-span-6 flex-col">
                        @error('photos') <span class="text-error float-right">{{ $message }}</span> @enderror
                        <div class="flex justify-end">
                            <div class="fa-2x pr-2">
                                <i class="fas fa-spinner fa-spin" wire:loading wire:target="save"></i>
                            </div>
                            <button type="submit" class="btn-sm btn-info float-right">
                                {{__('Upload Images')}}
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </form>
    @endif
    <div class="md:grid md:grid-cols-6 md:gap-6" id="images-post">
        @forelse ($images as $image)
            <div class="md:col-span-2 pb-2 relative" id="image-{{$image->id}}">
                <img class="h-48 w-full" src="{{ url($image->url) }}" alt="{{$image->name}}">
                <div class="flex justify-between items-center pt-1">
                    <span class="text-xs">{{$image->name}}</span>
                    <button class="btn-xs btn-info mr-1 copy" type="button" data-clipboard-text="{{url($image->url)}}">Copy url</button>
                </div>
                <div class="absolute top-2 right-2">
                    <button type="button" class="btn-xs btn-success mr-1" wire:click="select({{$image->id}})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn-xs btn-danger" onclick="eliminar({{$image->id}})">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            @empty
            <div class="md:col-span-6 text-center">
                <h2 class="text-base mt-2 mb-2">Sin Imagenes en el articulo</h2>
            </div>
        @endforelse
    </div>
    @if ($modal)
        <div class="z-50 overflow-auto fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center">
            <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-2xl">
                <div class="mt-3 sm:mt-0">
                    <h3 class="text-sm font-semibold pb-2">{{$image->name}}</h3>
                    <div class="block px-4 pb-2">
                        <label class="label">{{__('Name')}}</label>
                        <input wire:model="image.name" type="text" name="name" class="input-form @error('image.name') is-invalid @enderror">
                        @error('image.name') <span class="text-error">{{ $message }}</span> @enderror
                    </div>
                    {{-- <div class="block px-4 pb-2">
                        <textarea class="textarea" name="content" id="content" cols="5"></textarea>
                    </div> --}}
                    <div class="mt-4 text-center">
                        <button wire:click="update" class="btn-xs btn-success" type="button">
                            <span>{{__('Update')}}</span>
                        </button>
                        <button wire:click="cancel" type="button" class="btn-xs btn-warning">
                            <span>{{__('Cancel')}}</span>
                        </button>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6 text-right">
                    <button wire:click="cancel" type="button" class="btn-xs btn-danger-border">
                    {{__('Close')}}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <script>
        new ClipboardJS('.copy');
        function eliminar(id) {
            fetch('/sistema/dropzone/destroy', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({id})
            })
            .then(response => response.json())
            .then((data) => {
                if ( data.ok ) {
                    $(`#image-${id}`).remove();
                }
            })
            .catch(error => {
                console.error(error)
            })
            .finally(() => {
                console.error('finally delete image')
            })
        }
    </script>
@endpush