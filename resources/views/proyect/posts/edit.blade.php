@extends('layouts.app')

@section('title', __('Edit Article'))

@section('content')
<div class="" x-data="{modal:false, mobile:false}">
    <div class="inline-block w-full pb-2">
        <button class="btn-sm btn-primary-border w-full sm:w-auto" x-on:click="modal=true"><i class="fas fa-eye"></i> Vista Previa</button>
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
                <form action="{{ route('proyect.post.update', $post) }}" method="post" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-2">
                            <div class="block px-4 pb-2">
                                <label for="title" class="label">{{__('Article Title')}}</label>
                                <input type="text" name="title" id="title" class="input-form @error('title') is-invalid @enderror" placeholder="{{__('Article Title')}}" value="{{ $post->title }}">
                                @error('title') <span class="text-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="block px-4 pb-2">
                                <label for="resume" class="label">{{__('Resume')}}</label>
                                <textarea name="resume" id="resume" class="textarea @error('resume') is-invalid @enderror" placeholder="{{__('Resume')}}" rows="3">{{ $post->resume }}</textarea>
                                @error('resume') <span class="text-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="block px-4 pb-2">
                                <label for="image" class="label">{{__('Image Article')}}</label>
                                <input type="file" name="image" id="image" class="w-full text-gray-700 px-3 py-2 border rounded @error('image') is-invalid @enderror">
                                @error('image') <span class="text-error">{{ $message }}</span> @enderror
                            </div>
                            @if ($post->image)
                                <div class="rounded-lg shadow-lg bg-blue-400 w-full h-64 flex flex-row flex-wrap p-3 antialiased" 
                                style="
                                    background-image: url('{{ url($post->image) }}');
                                    background-size: cover;
                                    background-repeat: no-repeat;
                                    background-blend-mode: multiply;
                                "></div>
                            @endif
                        </div>
                        <div class="md:col-span-1">
                            <div class="block px-4 pb-2">
                                <label for="category_id" class="label mb-1">{{__('Category')}}</label>
                                <div class="w-full">
                                    @livewire('proyect.select2.categories', [
                                        'user' => current_user(),
                                        'category' => $post->category_id
                                    ], key(current_user()->id))
                                </div>
                                @error('category_id') <span class="text-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="block px-4 pb-1">
                                <label for="tags" class="label mb-2">{{__('Tags')}}</label>
                                <div class="w-full">
                                    @livewire('proyect.select2.tags', [
                                        'user' => current_user(),
                                        'selected_tags' => $post->tags
                                    ], key(current_user()->id))
                                </div>
                                @error('tags') <span class="text-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="py-2">
                                <button type="submit" class="btn-sm btn-update w-full">{{__('Update')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- article-content --}}
            <div class="md:grid md:grid-cols-3 md:gap-6" x-show="tab == '#article-content'" x-cloak>
                <div class="md:col-span-2">
                    <form method="POST" action="{{ route('proyect.post.content', $post) }}" id="article-content">
                        @csrf
                        <input type="hidden" name="body" id="body">
                        
                        <button type="submit" class="btn-sm btn-submit mt-2">{{__('Save Content')}}</button>
                    </form>
                </div>
                <div class="md:col-span-1">
                    <div class="text-xs sm:text-sm p-2 rounded whitespace-normal" id="preview">
                        {!!$post->body!!}
                    </div>
                </div>
            </div>
            {{-- article-images --}}
            <div class="md:grid md:grid-cols-3 md:gap-6" x-show="tab == '#article-images'" x-cloak>
                <div class="md:col-span-3">
                    <h2 class="text-base sm:text-3xl mt-2 mb-2">Drag &amp; Drop File Uploading using Laravel 8 Dropzone JS</h2>
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
    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" x-cloak x-show="modal">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle  sm:w-full p-4" role="dialog" aria-modal="true" aria-labelledby="modal-headline" :class="{ 'sm:max-w-lg': !mobile }">
                <div class="flex justify-between w-full pb-2">
                    <h1 class="text-lg font-semibold">{{__('Article Preview')}}</h1>
                    <div>
                        <button type="button" class="btn-xs btn-success-border mr-1" x-show="mobile" x-on:click="mobile=!mobile"><i class="fas fa-mobile"></i></button>
                        <button type="button" class="btn-xs btn-success-border mr-1" x-show="!mobile" x-on:click="mobile=!mobile"><i class="fas fa-desktop"></i></button>
                        <button type="button" class="btn-xs btn-danger-border mr-1" x-on:click="modal=false">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="rounded-lg shadow-lg bg-blue-400 w-full flex flex-row flex-wrap p-3 antialiased" 
                    @if ($post->image)
                    style="
                        background-image: url('{{ url($post->image) }}');
                        background-size: cover;
                        background-repeat: no-repeat;
                        background-blend-mode: multiply;
                    "
                    @endif
                >
                    <main class="h-full flex items-center p-6 lg:p-12 text-gray-700">
                        <section class="w-full md:w-9/12 xl:w-10/12">
                            <p class="text-xs font-bold mb-2 text-gray-700">{{$post->created_at->format('j F, Y')}}</p>
                            <h1 class="text-2xl lg:text-4xl font-bold pb-2 text-gray-200">
                                {{$post->title}}
                            </h1>
                            <p class="text-xs lg:text-base font-bold mb-1 text-white">{{$post->resume}}</p>
                        </section>
                    </main>
                </div>
                <article class="h-full flex items-center p-6">
                    <div class="w-full">
                        {!!$post->body!!}
                        {{-- {!! nl2br(e($post->body)) !!} --}}
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/basic.min.css" integrity="sha512-MeagJSJBgWB9n+Sggsr/vKMRFJWs+OUphiDV7TJiYu+TNQD9RtVJaPDYP8hA/PAjwRnkdvU+NsTncYTKlltgiw==" crossorigin="anonymous" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    
</style>
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