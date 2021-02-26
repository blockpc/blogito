@props(['user'])
<div class="flex flex-row w-full py-2">
    <img class="image_profile h-12 w-12 rounded-full mr-2" src="{{ image_profile($user) }}" alt="{{ config('app.name', 'BlockPC') }}<">
    <h3 class="font-semibold text-base text-gray-800 leading-tight mb-4 sm:mb-0 text-center sm:text-left">
        <span>{{$user->profile->fullname}}</span><br>
        <small>{{$user->email}}</small><br>
        <small>{{$user->profile->phone}}</small><br>
    </h3>
</div>