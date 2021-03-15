<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class Blockpc
{
    public static function current_user()
    {
        return auth()->user();
    }

    public static function route_active(string $route_name) : string
    {
        if ( !$route_name )
            return "";
        $route = Route::current()->getName();
        return Str::contains($route, $route_name) ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white';
    }

    public static function route_active_frontend(string $route_name)
    {
        if ( !$route_name )
            return "";
        $route = Route::current()->getName();
        return Str::contains($route, $route_name) ? 'bg-gray-900 text-white' : 'text-gray-800 hover:bg-gray-700 hover:text-gray-300';
    }

    public static function image_profile($user) : string
    {
        $user = $user ?? auth()->user();
        if ( $image = $user->profile->image ) {
            return $image->url;
        } else {
            $name = str_replace(" ", "+", $user->profile->fullName);
            return "https://ui-avatars.com/api/?name={$name}";
        }
    }

    public static function parse(int $type_id, string $content): string
    {
        $string = "";
        switch ($type_id) {
            case '1':
                // parrafo
                $string = $content;
                break;
            case '2':
                // codigo
                $string = $content;
                break;
            case '3':
                // cita
                $items = explode('|', $content);
                $cita = $items[0];
                $autor = $items[1] ?? [];
                $view = View::make('blog._cita', compact('cita', 'autor'));
                $string = $view->render();
                break;
            case '4':
                // lista
                $items = explode('|', $content);
                $items = array_filter($items, 'strlen');
                $view = View::make('blog._lista', compact('items'));
                $string = $view->render();
                break;
            case '5':
                // imagen
                $string = '<img class="object-cover h-48 w-full" src="'.$content.'" />';
                break;
            default:
                // otro tipo
                $string = $content;
                break;
        }
        return $string;
    }
}