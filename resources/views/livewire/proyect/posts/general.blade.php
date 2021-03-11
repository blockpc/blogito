<div>
    <form wire:submit.prevent="submit">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-2">
                <div class="block px-4 pb-2">
                    <label for="title" class="label">{{__('Article Title')}}</label>
                    <input wire:model="post.title" type="text" name="title" id="title" class="input-form @error('post.title') is-invalid @enderror" placeholder="{{__('Article Title')}}">
                    @error('post.title') <span class="text-error">{{ $message }}</span> @enderror
                </div>
                <div class="block px-4 pb-2">
                    <label for="resume" class="label">{{__('Resume')}}</label>
                    <textarea wire:model="post.resume" name="resume" id="resume" class="textarea @error('post.resume') is-invalid @enderror" placeholder="{{__('Resume')}}" rows="3"></textarea>
                    @error('post.resume') <span class="text-error">{{ $message }}</span> @enderror
                </div>
                <div class="block px-4 pb-2">
                    <label for="image" class="label">{{__('Image Article')}}</label>
                    <input wire:model="image" type="file" name="image" id="image" class="w-full text-gray-700 px-3 py-2 border rounded @error('image') is-invalid @enderror">
                    @error('image') <span class="text-error">{{ $message }}</span> @enderror
                </div>
                @if ($post->image)
                    <div class="rounded-lg shadow-lg bg-blue-400 w-full h-64 flex flex-row flex-wrap p-3 antialiased" 
                    style="
                        background-image: url( @if($image) '{{ $image->temporaryUrl() }}' @else '{{ url($post->image) }}' @endif);
                        background-size: cover;
                        background-repeat: no-repeat;
                        background-blend-mode: multiply;
                    "></div>
                @endif
            </div>
            <div class="md:col-span-1">
                <div class="block px-4 pb-2">
                    <label for="category_id" class="label mb-1">{{__('Category')}}</label>
                    <div wire:ignore class="w-full">
                        <select wire:model="post.category_id" name="category_id" class="select-form select2" id="category2" >
                            <option value="">-- {{__('Select Category')}} --</option>
                            @foreach($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id') <span class="text-error">{{ $message }}</span> @enderror
                </div>
                <div class="block px-4 pb-1">
                    <label for="tags" class="label mb-2">{{__('Tags')}}</label>
                    <div wire:ignore class="w-full">
                        <select wire:model="selected_tags" name="tags[]" multiple="multiple" class="select-form select2" id="tag2"
                        data-placeholder="Seleccione las etiquetas"
                        data-allow-clear="false"
                        title="Seleccione las etiquetas...">
                            @foreach($tags as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
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

@push('scripts')
    <script>
    $(document).ready(function() {
        $('#category2').select2();
        $('#category2').on('change', function (e) {
            var data = $('#category2').select2("val");
            @this.set('post.category_id', data);
        });
        $('#tag2').select2();
        $('#tag2').on('change', function (e) {
            var data = $('#tag2').select2("val");
            @this.set('selected_tags', data);
        });
    });
    </script>
@endpush
