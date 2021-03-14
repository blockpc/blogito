<div>
    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" x-cloak x-show="modal">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle w-full p-4" role="dialog" aria-modal="true" aria-labelledby="modal-headline" :class="{ 'md:w-9/12 lg:w-8/12': !mobile }">
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
                    <main class="w-full md:w-9/12 lg:w-8/12 mx-auto flex items-center p-6 lg:p-12 text-gray-700 relative">
                        <div class="absolute right-0 top-2 badge-sm badge-success z-20">
                            <a class="text-sm font-semibold p-1 mx-2" href="#">{{$post->category->name}}</a>
                        </div>
                        <section class="w-full md:w-9/12 xl:w-10/12">
                            <p class="text-xs font-bold mb-2 text-gray-700">{{$post->created_at->format('j F, Y')}}</p>
                            <h1 class="text-2xl lg:text-4xl font-bold pb-2 text-gray-200">
                                {{$post->title}}
                            </h1>
                            <p class="text-xs lg:text-base font-bold mb-1 text-white">{{$post->resume}}</p>
                        </section>
                    </main>
                </div>
                <article class="flex items-center p-6 font-sans">
                    <div class="w-full md:w-9/12 lg:w-8/12 mx-auto">
                        @foreach ($post->blocks as $item)
                        <div class="p-1">
                            {!! html_entity_decode($item->type->start) !!}{{$item->content}}{!! html_entity_decode($item->type->end) !!}
                        </div>
                        @endforeach
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
