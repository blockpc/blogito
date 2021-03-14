<div class="float-right">
    @foreach ($item->tags as $tag)
        <a class="inline-block text-sm text-gray-800 font-semibold p-1" href="{{ route('blog.tags', $tag) }}" title="{{Str::title($tag->description)}}">#{{Str::title($tag->name)}}</a>
    @endforeach
</div>