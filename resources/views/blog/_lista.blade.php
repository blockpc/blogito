<div class="text-sm">
    @foreach ($items as $item)
    <div class="flex justify-start text-gray-700 rounded-md p-2">
        <span class="bg-gray-400 h-2 w-2 m-2 rounded-full"></span>
        <div class="flex-grow font-medium px-2">{{$item}}</div>
    </div>
    @endforeach
</div>