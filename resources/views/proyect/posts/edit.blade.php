@extends('layouts.app')

@section('title', __('Edit Article'))

@section('content')
<div class="" x-data="{modal:false, mobile:false}">
    <div class="inline-block w-full pb-2">
        <button type="button" class="btn-sm btn-primary-border w-full sm:w-auto" x-on:click="modal=true"><i class="fas fa-eye"></i> Vista Previa</button>
    </div>
    <div x-data="{ tab: window.location.hash ? window.location.hash : '#article-information' }" class="">
        <div class="flex flex-row justify-between pb-4">
            <a class="text-sm sm:text-base p-2 m-2 rounded-md bg-gray-200 hover:bg-blue-200 w-full text-center" 
                href="#" x-on:click.prevent="tab='#article-information'" :class="{ 'bg-blue-200': tab=='#article-information' }">{{__('Article Data')}}</a>
            <a class="text-sm sm:text-base p-2 m-2 border-b-2 bg-gray-200 hover:bg-blue-200 w-full text-center" 
                href="#" x-on:click.prevent="tab='#article-content'" :class="{ 'bg-blue-200': tab=='#article-content' }">{{__('Content')}}</a>
            <a class="text-sm sm:text-base p-2 m-2 border-b-2 bg-gray-200 hover:bg-blue-200 w-full text-center" 
                href="#" x-on:click.prevent="tab='#article-images'" :class="{ 'bg-blue-200': tab=='#article-images' }">{{__('Images')}}</a>
        </div>
        <div class="p-2">
            {{-- article-information --}}
            <div x-show="tab == '#article-information'" x-cloak>
                @livewire('proyect.posts.general', [
                    'user' => current_user(),
                    'post' => $post
                ], key(current_user()->id))
            </div>
            {{-- article-content --}}
            <div x-show="tab == '#article-content'" x-cloak>
                @livewire('proyect.posts.content', [
                    'user' => current_user(),
                    'post' => $post
                ], key(current_user()->id))
            </div>
            {{-- article-images --}}
            <div class="md:grid md:grid-cols-3 md:gap-6" x-show="tab == '#article-images'" x-cloak>
                <div class="md:col-span-3">
                    <div class="border border-dashed border-gray-500 relative m-4 pb-2">
                        <form action="{{ route('dropzone.store', $post) }}" method="post" enctype="multipart/form-data" id="dropzone" class="dropzone">
                            @csrf
                            <div class="dz-message">
                                <h3 class="text-sx sm:text-base m-2">{{__('Upload Multiple Image By Click On Box')}}</h3>
                            </div>
                        </form>
                    </div>
                    <div class="md:grid md:grid-cols-6 md:gap-6" id="images-post">
                        @forelse ($post->images as $image)
                        <div class="md:col-span-2" id="image-{{$image->id}}">
                            <img src="{{ url($image->url) }}" alt="{{$image->name}}">
                            <div class="flex justify-between items-center pt-1">
                                <span class="text-xs">{{$image->name}}</span>
                                <button type="button" class="btn-xs btn-danger" onclick="eliminar({{$image->id}})"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        @empty
                        <div class="md:col-span-6 text-center">
                            <h2 class="text-base mt-2 mb-2">Sin Imagenes en el articulo</h2>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Vista Previa-->
    @livewire('proyect.posts.preview', [
        'user' => current_user(),
        'post' => $post
    ], key(current_user()->id))
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/basic.min.css" integrity="sha512-MeagJSJBgWB9n+Sggsr/vKMRFJWs+OUphiDV7TJiYu+TNQD9RtVJaPDYP8hA/PAjwRnkdvU+NsTncYTKlltgiw==" crossorigin="anonymous" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/agate.css') }}">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/min/dropzone.min.js" integrity="sha512-En/Po50Bl8kIECa2WkhxhdYeoKDcrJpBKMo9tmbuwbm9RxHWZV8/Y5xM9sh3QbrnFgM3hVR/2umJ33qGJk45pQ==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    Dropzone.options.dropzone = {
        maxFilesize : 1,
        maxFiles: 6,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        thumbnailHeight: 120,
        thumbnailWidth: 120,
        thumbnail: function (file, dataUrl) {
            if (file.previewElement) {
                file.previewElement.classList.remove("dz-file-preview");
                var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
                for (var i = 0; i < images.length; i++) {
                    var thumbnailElement = images[i];
                    thumbnailElement.alt = file.name;
                    thumbnailElement.src = dataUrl;
                }
                setTimeout(function () {
                    file.previewElement.classList.add("dz-image-preview");
                }, 1);
            }
        },
        init: function() {
            this.on("addedfile", function(file) {
                console.log("Added file.");
            }),
            this.on("success", function(file, response) {
                let html = `<div class="md:col-span-2" id="image-${response.id}">
                    <img src="${response.url}" alt="${response.name}">
                    <div class="flex justify-between items-center pt-1">
                        <span class="text-xs">${response.name}</span>
                        <button type="button" class="btn-xs btn-danger" onclick="eliminar(${response.id})"><i class="fas fa-times"></i></button>
                    </div>
                </div>`;
                if ( response.contador == 1 ) {
                    $("#images-post").html("");
                }
                $("#images-post").append(html);
            }),
            this.on("complete", function(file) {
                this.removeFile(file);
            })
        }
    };
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