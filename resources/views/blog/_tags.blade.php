<div class="w-full md:w-9/12 lg:w-8/12 mx-auto px-6 sm:px-12 text-center p-1">
    @foreach ($tags as $item)
        @if ($item->posts_count)
        <a class="inline-block p-1" href="{{ route('blog.tags', $item) }}" title="{{Str::title($item->description)}}">
            <span class="badge-xs sm:badge-sm badge-info-border">#{{Str::title($item->name)}} <span class="badge-xs badge-info">{{$item->posts_count}}</span></span>
        </a>
        @endif
    @endforeach
</div>