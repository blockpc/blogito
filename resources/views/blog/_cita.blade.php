<div class="flex">
    <blockquote class="w-full flex flex-wrap flex-col bg-white text-indigo-700 border-l-8 italic border-gray-400 px-4 py-3">
        <p>{{$cita}}</p>
        @if ($autor)
        <span class="flex justify-end text-sm text-indigo-400 font-semibold pt-2 underline">{{$autor}}</span>
        @endif
    </blockquote>
</div>