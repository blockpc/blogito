<?php

use App\Helpers\Blockpc;
use Illuminate\Support\Str;

if (! function_exists('current_user')) {
    function current_user() {
        return Blockpc::current_user();
    }
}

if (! function_exists('route_active') ) {
    function route_active(string $route_name) {
        return Blockpc::route_active($route_name);
    }
}

if (! function_exists('route_active_frontend') ) {
    function route_active_frontend(string $route_name) {
        return Blockpc::route_active_frontend($route_name);
    }
}

if (! function_exists('image_profile') ) {
    function image_profile($user = null) {
        return Blockpc::image_profile($user);
    }
}