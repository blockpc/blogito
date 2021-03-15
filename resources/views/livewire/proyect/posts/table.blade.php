<div>
    <div class="inline-block items-center w-full py-2">
        <label class="inline-flex items-center mt-3">
            <input wire:model="published" type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" checked><span class="ml-2 text-gray-700">{{__('Published')}}</span>
        </label>
        <button wire:click="toggle_modal" type="button" class="btn-sm btn-primary-border float-right"><i class="fas fa-plus mr-1"></i> {{__('New Article')}}</button>
    </div>
    @if ($posts->count())
    <div class="inline-block-py-2">
        @include('partials.custom-search')
    </div>
    @endif
    <div class="table-responsive py-2">
        <table class="table table-sm table-hover table-striped">
            <thead>
                <tr class="">
                    <x-table-th 
                        wire:click="sortBy('title')" field="title" sortField={{$sortField}} direction={{$sortDirection}}>
                        {{__('Title')}}
					</x-table-th>
                    <x-table-th 
                        wire:click="sortBy('resume')" field="resume" sortField={{$sortField}} direction={{$sortDirection}}>
                        {{__('Resume')}}
					</x-table-th>
                    <x-table-th 
                        wire:click="sortBy('published_at')" field="published_at" sortField={{$sortField}} direction={{$sortDirection}}>
                        {{__('Published')}}
					</x-table-th>
                    <x-table-th 
                        wire:click="sortBy('blocks_count')" field="blocks_count" sortField={{$sortField}} direction={{$sortDirection}}>
                        {{__('Blocks')}}
					</x-table-th>
                    <x-table-th 
                        wire:click="sortBy('tags_count')" field="tags_count" sortField={{$sortField}} direction={{$sortDirection}}>
                        {{__('Tags')}}
					</x-table-th>
                    <x-table-th 
                        wire:click="sortBy('images_count')" field="images_count" sortField={{$sortField}} direction={{$sortDirection}}>
                        {{__('Images')}}
					</x-table-th>
                    <th class="th text-right">{{__('Actions')}}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $item)
                    <tr class="">
                        <td class="td">{{$item->title}}</td>
                        <td class="td">{!! nl2br(e($item->resume)) !!}</td>
                        <td class="td text-center">{{$item->published_at ? $item->published_at->format('j F, Y') : 'No'}}</td>
                        <td class="td text-center">{{$item->blocks_count}}</td>
                        <td class="td text-center">{{$item->tags_count}}</td>
                        <td class="td text-center">{{$item->images_count}}</td>
                        <td class="td text-right">
                            <div class="flex flex-row justify-end" role="group">
                                <a href="{{route('blog.show', $item->url)}}" target="_blank" class="btn-xs btn-primary-border mr-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('proyect.post.edit', $item) }}" type="button" class="btn-xs btn-success-border mr-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if (!$item->posts_count)
                                    @include('partials.custom-delete', [
                                        'id' => $item->id,
                                        'message' => __('Are you sure you want to delete this article?')
                                    ])
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td class="td text-center" colspan="4">Sin categorías registradas</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="block py-2">
        {{ $posts->links('partials.custom-pagination') }}
    </div>
    @if ($modal)
        @include('livewire.proyect.posts.modal')
    @endif
</div>
