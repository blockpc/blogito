<div>
    <div class="flex flex-col justify-center items-center pt-2 pb-10 px-6">
        <div class="w-full mx-auto relative" x-data="{ activeSlide: 1, slides: [1, 2, 3, 4, 5],
            loop() { setInterval(() => { this.activeSlide = this.activeSlide === 5 ? 1 : this.activeSlide+1 }, 3000) }}"
            x-init="loop">
            <!-- Slides -->
            <template x-for="slide in slides" :key="slide">
                <div class="font-bold text-5xl h-64 flex items-center bg-gray-500 text-gray-700 rounded-lg"
                    x-show="activeSlide === slide">
                    @foreach ($latest as $item)
                    <div class="rounded-lg shadow-lg bg-blue-400 w-full h-64 flex flex-row flex-wrap antialiased"
                        style="background-image: url(@if($item->image) '{{ url($item->image) }}' @else 'https://picsum.photos/200/300?random={{$loop->iteration}}' @endif);
                            background-size: cover;
                            background-repeat: no-repeat;
                            background-blend-mode: multiply;" 
                            x-show="{{$loop->iteration}} == slide">
                            <div class="absolute right-0 top-2 flex rounded-l-full z-20 bg-green-200 text-green-600">
                                <a class="text-sm font-semibold p-1 mx-2" href="#">{{$item->category->name}}</a>
                            </div>
                            <div class="absolute h-full flex items-center p-6 sm:p-8 lg:p-12 text-gray-700 z-10">
                                <section class="w-full md:w-9/12 xl:w-10/12">
                                    <p class="text-xs font-bold mb-2 text-gray-300">{{$item->created_at->format('j F, Y')}}</p>
                                    <h1 class="text-lg sm:text-2xl lg:text-4xl font-bold pb-2 text-gray-200">
                                        {{$item->title}}
                                    </h1>
                                    <p class="text-xs lg:text-base font-normal mb-1 text-white">{{$item->resume}}</p>
                                </section>
                            </div>
                            <div class="absolute bottom-2 left-2 pl-6 sm:pl-8 lg:pl-12 z-20">
                                <a class="text-xs sm:text-base font-bold text-white" href="{{ route('blog.show', $item) }}">{{__('Read more...')}}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </template>
            <!-- Prev/Next Arrows -->
            <div class="absolute inset-0 flex">
                <div class="flex items-center justify-start w-1/2">
                    <button 
                        class="bg-blue-100 text-blue-300 hover:bg-blue-300 hover:text-blue-100 font-bold hover:shadow-lg rounded-full w-12 h-12 -ml-6 focus:ring-0 focus:outline-none"
                        x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">
                        <i class="fas fa-arrow-left fa-lg"></i>
                    </button>
                </div>
                <div class="flex items-center justify-end w-1/2">
                    <button 
                        class="bg-blue-100 text-blue-300 hover:bg-blue-300 hover:text-blue-100 font-bold hover:shadow rounded-full w-12 h-12 -mr-6 focus:ring-0 focus:outline-none"
                        x-on:click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1">
                        <i class="fas fa-arrow-right fa-lg"></i>
                    </button>
                </div>        
            </div>
            <!-- Buttons -->
            <div class="absolute w-full flex items-center justify-center p-4">
                <template x-for="slide in slides" :key="slide">
                    <button
                        class="w-4 h-4 mx-2 mb-0 rounded-full transition-colors duration-200 ease-out hover:bg-gray-600 hover:shadow-lg focus:ring-0 focus:outline-none"
                        :class="{ 
                            'bg-blue-600': activeSlide === slide,
                            'bg-blue-300': activeSlide !== slide 
                        }" 
                        x-on:click="activeSlide = slide"
                    ></button>
                </template>
            </div>
        </div>
    </div>
</div>