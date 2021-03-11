<div>
    <div class="md:grid md:grid-cols-6 md:gap-6">
        <div class="md:col-span-3 mb-2">
            <form wire:submit.prevent="submit">
                <div class="block px-4 pb-2">
                    <label for="type_id" class="label">{{__('Type Block')}}</label>
                    <select wire:model.lazy="block.type_id" class="select-form @error('block.type_id') is-invalid @enderror" name="type_id" id="type_id">
                        <option value="0">{{__('Select')}}...</option>
                        @foreach ($types as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('block.type_id') <span class="text-error">{{ $message }}</span> @enderror
                </div>
                <div class="block px-4 pb-2 h-full">
                    <label for="content" class="label">{{__('Content Block')}}</label>
                    <textarea wire:model.lazy="block.content" class="textarea resize-none h-full @error('block.content') is-invalid @enderror" name="content" id="content" rows="5"></textarea>
                    @error('block.content') <span class="text-error">{{ $message }}</span> @enderror
                </div>
                <div class="block px-4 pb-2">
                    <button type="submit" class="btn-sm btn-info mt-2">{{__('Save Content')}}</button>
                    <button wire:click="cancel" type="button" class="btn-sm btn-warning mt-2">{{__('Cancel')}}</button>
                </div>
            </form>
        </div>
        <div class="md:col-span-3 mb-2">
            <div x-data="{selected:null}">
                @foreach ($blocks as $index => $item)
                    <div class="flex-col mb-1 bg-indigo-100" @click="selected !== {{$index}} ? selected = {{$index}} : selected = null">
                        <div class="flex justify-between items-center text-xs py-1 px-2" :class="{'bg-indigo-200': selected == {{$index}}}">
                            <span class="font-semibold">{{$item->type->name}}</span>
                            <span class="">{{Str::limit($item->content, 40)}}</span>
                            <div class="flex flex-row justify-end" role="group">
                                <button wire:click="select({{$item->id}})" class="btn-xs btn-success-border mr-1"><i class="fas fa-edit"></i></button>
                                @include('partials.custom-delete', [
                                    'id' => $item->id,
                                    'message' => __('Are you sure you want to delete this block?')
                                ])
                            </div>
                        </div>
                        <div class="text-sm py-1 px-2" x-show="selected == {{$index}}">{{ Str::limit($item->content, 140) }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
