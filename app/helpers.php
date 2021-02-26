<?php

use Illuminate\Support\Str;

if (! function_exists('current_user')) {
    function current_user() {
        return auth()->user();
    }
}

if (! function_exists('route_active') ) {
    function route_active(string $route_name) {
        if ( !$route_name )
            return "";
        $route = Route::current()->getName();
        return Str::contains($route, $route_name) ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white';
    }
}

if (! function_exists('image_profile') ) {
    function image_profile($user = null) {
        $user = $user ?? auth()->user();
        if ( $image = $user->profile->image ) {
            return $image->url;
        } else {
            $name = str_replace(" ", "+", $user->profile->fullName);
            return "https://ui-avatars.com/api/?name={$name}";
        }
    }
}