<div class="w-full md:w-9/12 lg:w-8/12 mx-auto px-6 sm:px-12 text-center p-1">
    @foreach ($categories as $item)
        @if ($item->posts_count)
        <a class="inline-block p-1" href="{{ route('blog.categories', $item) }}" title="{{Str::title($item->description)}}">
            <span class="badge-xs sm:badge-sm badge-success-border">{{Str::title($item->name)}} <span class="badge-xs badge-success">{{$item->posts_count}}</span></span>
        </a>
        @endif
    @endforeach
</div>