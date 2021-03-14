<div>
    <div class="inline-block w-full py 2">
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
                    <th class="th">{{__('Title')}}</th>
                    <th class="th">{{__('Resume')}}</th>
                    <th class="th text-center">{{__('Blocks')}}</th>
                    <th class="th text-center">{{__('Images')}}</th>
                    <th class="th text-right">{{__('Actions')}}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $item)
                    <tr class="">
                        <td class="td">{{$item->title}}</td>
                        <td class="td">{!! nl2br(e($item->resume)) !!}</td>
                        <td class="td text-center">{{$item->blocks_count}}</td>
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
