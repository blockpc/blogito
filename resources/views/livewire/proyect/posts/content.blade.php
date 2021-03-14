<div>
    <div class="md:grid md:grid-cols-6 md:gap-6">
        <div class="md:col-span-3 mb-2">
            <form wire:submit.prevent="submit">
                <div class="block px-4 pb-2">
                    <label for="type_id" class="label">{{__('Type Block')}}</label>
                    <select wire:model.lazy="block.type_id" class="select-form @error('block.type_id') is-invalid @enderror" name="type_id" id="type_id">
                        <option value="0">{{__('Select')}}...</option>
                        @foreach ($types as $item)
                            <option value="{{$item->id}}">{{Str::title($item->name)}}</option>
                        @endforeach
                    </select>
                    @error('block.type_id') <span class="text-error">{{ $message }}</span> @enderror
                </div>
                <div class="block px-4 pb-2 h-full">
                    <label for="block-title" class="label">{{__('Title Block')}}</label>
                    <input wire:model="block.title" type="text" name="title" id="block-title" class="input-form @error('block.title') is-invalid @enderror" placeholder="{{__('Title Block')}}">
                    @error('block.title') <span class="text-error">{{ $message }}</span> @enderror
                </div>
                <div class="block px-4 pb-2 h-full">
                    <label for="content" class="label">{{__('Content Block')}}</label>
                    <textarea wire:model.lazy="block.content" class="textarea resize-y h-full @error('block.content') is-invalid @enderror" name="content" id="content" rows="5"></textarea>
                    @error('block.content') <span class="text-error">{{ $message }}</span> @enderror
                </div>
                <div class="block px-4 pb-2 h-full">
                    <label for="legend" class="label">{{__('Legend Block')}}</label>
                    <input wire:model="block.legend" type="text" name="legend" id="legend" class="input-form @error('block.legend') is-invalid @enderror" placeholder="{{__('Legend Block')}}">
                    @error('block.legend') <span class="text-error">{{ $message }}</span> @enderror
                </div>
                <div class="block px-4 pb-2">
                    <button type="submit" class="btn-sm btn-info mt-2">{{__('Save Content')}}</button>
                    <button wire:click="cancel" type="button" class="btn-sm btn-warning mt-2">{{__('Cancel')}}</button>
                </div>
            </form>
        </div>
        <div class="md:col-span-3 mb-2">
            <div class="pb-2" id="update-block-order" 
                wire:sortable="updateBlockOrder">
                @foreach ($blocks as $index => $item)
                    <div class="flex-col mb-1 bg-indigo-100 focus:outline-none" 
                        wire:sortable.item="{{ $loop->index }}" 
                        wire:key="item-{{ $loop->index }}">
                        <div class="flex justify-between items-center py-1 px-2 text-sm">
                            <span class="cursor-move mr-2" wire:sortable.handle>
                                <i class="fas fa-arrows-alt"></i>
                            </span>
                            <div class="w-full flex justify-between cursor-pointer">
                                <span class="">{{Str::limit($item->title ?? $item->content, 40)}}</span>
                                <span class="font-semibold mr-2">{{Str::title($item->type->name)}}</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center p-1">
                            <div class="text-xs py-1 px-2">{{ Str::limit($item->content, 140) }}</div>
                            <div class="flex" role="group">
                                <div>
                                    <button wire:click="select({{$item->id}})" class="btn-xs btn-success-border mr-1"><i class="fas fa-edit"></i></button>
                                </div>
                                @include('partials.custom-delete', [
                                    'id' => $item->id,
                                    'message' => __('Are you sure you want to delete this block?')
                                ])
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        // MobileDragDrop.polyfill({holdToDrag: 300, dragImageTranslateOverride: 
        // MobileDragDrop.scrollBehaviourDragImageTranslateOverride});
    </script>
@endpush