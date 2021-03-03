<?php

namespace App\Http\Controllers\Proyect;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('proyect.tags.index');
    }
}
